;(function () {
  const button = document.getElementById("save2pdf")
  const certificate = document.getElementById("certificate-document")

  if (!button || !certificate) return

  // html2pdf renders the clone inside a container it sizes to the PDF page width
  // (21cm), html2canvas rounds those bounds up before scaling, and toPdf() then
  // slices the canvas every floor(canvasWidth * pageRatio) pixels. Rebuilding that
  // same arithmetic here lets every sheet land exactly on one PDF page.
  const SCALE = 2
  const PAGE_CM = { width: 21, height: 29.7 }
  const PX_PER_CM = 96 / 2.54

  const SHEET_WIDTH = Math.ceil(PAGE_CM.width * PX_PER_CM)
  const PX_PAGE_HEIGHT = Math.floor(SHEET_WIDTH * SCALE * (PAGE_CM.height / PAGE_CM.width))
  const SHEET_HEIGHT = PX_PAGE_HEIGHT / SCALE

  certificate.style.setProperty("--sheet-width", SHEET_WIDTH + "px")
  certificate.style.setProperty("--sheet-height", SHEET_HEIGHT + "px")

  const source = readSource()

  function readSource() {
    const sheet = certificate.querySelector(".certificate-sheet")
    const table = sheet.querySelector("[data-certificate-table]")

    return {
      letterhead: sheet.querySelector("[data-certificate-letterhead]").cloneNode(true),
      masthead: sheet.querySelector("[data-certificate-masthead]").cloneNode(true),
      intro: sheet.querySelector("[data-certificate-intro]").cloneNode(true),
      footer: sheet.querySelector("[data-certificate-footer]").cloneNode(true),
      thead: table.tHead.cloneNode(true),
      rows: Array.from(table.tBodies[0].rows).map((row) => row.cloneNode(true)),
    }
  }

  function addSheet() {
    const sheet = document.createElement("section")
    sheet.className = "certificate-sheet"
    sheet.style.height = SHEET_HEIGHT + "px"
    // The stylesheet's min-height is only the pre-pagination fallback; leaving it
    // in place would override the trim numberSheets() applies to the last sheet.
    sheet.style.minHeight = "0"
    sheet.appendChild(source.letterhead.cloneNode(true))

    const inner = document.createElement("div")
    inner.className = "certificate-inner"
    inner.appendChild(source.masthead.cloneNode(true))

    const body = document.createElement("div")
    body.className = "certificate-body"
    inner.appendChild(body)
    sheet.appendChild(inner)

    const pagination = document.createElement("div")
    pagination.className = "sheet-pagination"
    sheet.appendChild(pagination)

    certificate.appendChild(sheet)

    return { sheet: sheet, body: body }
  }

  function addTable(body) {
    const table = document.createElement("table")
    table.className = "certificate-content"
    table.appendChild(source.thead.cloneNode(true))
    table.appendChild(document.createElement("tbody"))
    body.appendChild(table)

    return table
  }

  function overflows(body) {
    return body.scrollHeight > body.clientHeight
  }

  function paginate() {
    certificate.replaceChildren()

    let current = addSheet()
    current.body.appendChild(source.intro.cloneNode(true))

    let table = addTable(current.body)

    source.rows.forEach(function (row) {
      const clone = row.cloneNode(true)
      table.tBodies[0].appendChild(clone)

      if (!overflows(current.body)) return

      table.tBodies[0].removeChild(clone)

      // A row taller than a whole sheet can never fit; keep it where it is instead
      // of opening an empty sheet for it on every pass.
      if (!table.tBodies[0].rows.length) {
        table.tBodies[0].appendChild(clone)
        return
      }

      current = addSheet()
      table = addTable(current.body)
      table.tBodies[0].appendChild(clone)
    })

    if (!table.tBodies[0].rows.length) table.remove()

    const footer = source.footer.cloneNode(true)
    current.body.appendChild(footer)

    if (overflows(current.body)) {
      current.body.removeChild(footer)
      current = addSheet()
      current.body.appendChild(footer)
    }

    numberSheets()
  }

  function numberSheets() {
    const sheets = Array.from(certificate.querySelectorAll(".certificate-sheet"))

    // html2canvas rounds the container height up, so a stack that measures a
    // fraction over N pages would spill a blank page N+1. Shave the last sheet
    // down to the nearest whole pixel under the N-page mark.
    const stack = Math.floor((sheets.length * PX_PAGE_HEIGHT) / SCALE)
    sheets[sheets.length - 1].style.height = stack - (sheets.length - 1) * SHEET_HEIGHT + "px"

    sheets.forEach(function (sheet, index) {
      sheet.querySelector(".sheet-pagination").textContent =
        sheets.length > 1 ? "Page " + (index + 1) + " of " + sheets.length : ""
    })
  }

  function ready() {
    const fonts = document.fonts ? document.fonts.ready : Promise.resolve()
    const loaded =
      document.readyState === "complete"
        ? Promise.resolve()
        : new Promise(function (resolve) {
            window.addEventListener("load", resolve, { once: true })
          })

    return Promise.all([fonts, loaded])
  }

  function download() {
    const timestamp = new Date().toISOString().slice(0, 19).replace(/:/g, "-")

    const options = {
      margin: 0,
      filename: `certificate-${timestamp}.pdf`,
      image: { type: "jpeg", quality: 0.95 },
      html2canvas: { scale: SCALE, useCORS: true, backgroundColor: "#ffffff" },
      jsPDF: { unit: "cm", format: "a4", orientation: "portrait" },
      // The sheets are already page-sized; any break html2pdf inserted would push
      // the content out of alignment with the slices.
      pagebreak: { mode: [] },
    }

    button.disabled = true

    certificate.classList.add("is-exporting")

    const done = function () {
      certificate.classList.remove("is-exporting")
      button.disabled = false
    }

    html2pdf().set(options).from(certificate).save().then(done, done)
  }

  // Fonts and the signature images land after first paint, so the sheets cannot be
  // measured yet. Hold the button until they have been, otherwise an early click
  // would export the unpaginated fallback sheet.
  const enable = function () {
    button.disabled = false
  }

  button.disabled = true

  ready().then(paginate).then(enable, enable)

  button.addEventListener("click", download)
})()
