 <!-- Required vendors -->
 <script src="{{ url('assets/vendor/global/global.min.js') }}"></script>
 <script src="{{ url('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
 <!-- Apex Chart -->
 <script src="{{ url('assets/vendor/apexchart/apexchart.js') }}"></script>

 <!-- Datatable -->
 <script src="{{ url('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ url('assets/js/plugins-init/datatables.init.js') }}"></script>
 <script src="{{ url('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
 <script src="{{ url('assets/js/custom.min.js') }}"></script>
 <script src="{{ url('assets/js/dlabnav-init.js') }}"></script>

	
	
	<!-- Chart piety plugin files -->
    {{-- <script src="{{ url('assets/vendor/peity/jquery.peity.min.js') }}"></script> --}}
	<!-- Dashboard 1 -->
	<script src="{{ url('assets/js/dashboard/dashboard-1.js') }}"></script>
	
	<script src="{{ url('assets/vendor/owl-carousel/owl.carousel.js') }}"></script>

	<script>
		$(document).ready(function() {
			$("#show_hide_current_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_current_password input').attr("type") == "text") {
					$('#show_hide_current_password input').attr('type', 'password');
					$('#show_hide_current_password i').removeClass("fa-eye-slash");
					$('#show_hide_current_password i').addClass("fa-eye");
				} else if ($('#show_hide_current_password input').attr("type") == "password") {
					$('#show_hide_current_password input').attr('type', 'text');
					$('#show_hide_current_password i').removeClass("fa-eye");
					$('#show_hide_current_password i').addClass("fa-eye-slash");
				}
			});
	
			$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').removeClass("fa-eye-slash");
					$('#show_hide_password i').addClass("fa-eye");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("fa-eye");
					$('#show_hide_password i').addClass("fa-eye-slash");
				}
			});
	
			$("#show_hide_password_confirmation a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password_confirmation input').attr("type") == "text") {
					$('#show_hide_password_confirmation input').attr('type', 'password');
					$('#show_hide_password_confirmation i').removeClass("fa-eye-slash");
					$('#show_hide_password_confirmation i').addClass("fa-eye");
				} else if ($('#show_hide_password_confirmation input').attr("type") == "password") {
					$('#show_hide_password_confirmation input').attr('type', 'text');
					$('#show_hide_password_confirmation i').removeClass("fa-eye");
					$('#show_hide_password_confirmation i').addClass("fa-eye-slash");
				}
			});
		});
	</script>
	<script>
		document.getElementById('toggleCurrentPassword').addEventListener('click', function () {
			var input = document.getElementById('current_password');
			if (input.type === "password") {
				input.type = "text";
			} else {
				input.type = "password";
			}
		});
	</script>

 @stack('scripts')