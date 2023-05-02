<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Great Kings Academy</span></strong>. <br />All Rights Reserved
    </div>
    <div class="credits">
      Designed by Ndunche Joseph
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
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
  <script src="assets/js/jquery-3.6.0.js"></script>
  <script>
  const social_btn = document.getElementsByClassName("like");

  for(let i=0; i < social_btn.length; i++){
    social_btn.onclick = () => {
    
      social_btn[i].classList.remove('bi-heart');
      social_btn[i].classList.add('bi-heart-fill');
  }

}

const message = document.querySelector('.message');

message.onkeyup = (e) =>{
  message.style.height = "auto";
  let scHeight = e.target.scrollHeight;
  message.style.height = `${scHeight}px`;
}

 </script>

</body>

</html>