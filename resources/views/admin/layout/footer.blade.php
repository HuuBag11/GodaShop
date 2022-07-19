<footer class="sticky-footer">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span>Copyright © Godashop 2022</span>
      </div>
   </div>
</footer>      <!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn thoát?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
            <a class="btn btn-primary" href="{{ URL::to('/logout') }}">Thoát</a>
         </div>
      </div>
   </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugin JavaScript-->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin.min.js') }}"></script>
<!-- Demo scripts for this page-->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
{{-- <script src="../vendor/format/number_format.js"></script> --}}
<script src="{{ asset('admin/js/admin.js') }}"></script>
</body>
</html>
