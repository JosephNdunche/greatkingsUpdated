
  <!-- Vendor JS Files -->
  <script src="assets/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/assets/vendor/quill/quill.min.js"></script>
  <script src="assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/assets/js/main.js"></script>

  <script>
const message = document.querySelector('.message');

message.onkeyup = (e) =>{
  message.style.height = "auto";
  let scHeight = e.target.scrollHeight;
  message.style.height = `${scHeight}px`;
}
  </script>

</body>

</html>