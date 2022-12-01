const save2pdf = document.getElementById("save2pdf")
save2pdf.addEventListener("click", () => {
  const certificatePage = document.querySelector(".certificate-page")

  const options = {
    margin: 0,
    filename: "test.pdf",
    image: { type: "jpg", quality: 0.98 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  }

  html2pdf().set(options).from(certificatePage).save()
})
