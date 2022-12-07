const save2pdf = document.getElementById("save2pdf")
save2pdf.addEventListener("click", () => {
  const certificatePage = document.querySelector(".certificate-page")
  const timestamp = new Date().toISOString().slice(0, 19).replace(/:/g, "-")

  const options = {
    margin: 0,
    filename: `certificate-${timestamp}.pdf`,
    image: { type: "jpg", quality: 0.98 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  }

  html2pdf().set(options).from(certificatePage).save()
})
