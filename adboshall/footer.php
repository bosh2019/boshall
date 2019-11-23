   <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
 <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
    <script src="assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
     <script src="assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>     <script src="assets/lib/jquery/jquery.validate.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo $baseurl?>/javascript/scripts.js" type="text/javascript"></script>
<script src="assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="assets/lib/countup/countUp.min.js" type="text/javascript"></script>
  <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="assets/lib/summernote/summernote-ext-beagle.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="assets/lib/markdown-js/markdown.js" type="text/javascript"></script>

    <script src="assets/lib/jquery.magnific-popup/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <script src="assets/lib/masonry/masonry.pkgd.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
		      	App.dataTables();
				App.textEditors();
				App.dashboard();
					App.IconsFilter();

      });
       $(window).on('load',function(){
      	App.pageGallery();
      });
    </script>