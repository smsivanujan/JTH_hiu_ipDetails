<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

<!-- JQUERY JS -->
{{-- <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script> --}}

<!-- BOOTSTRAP JS -->
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- SIDE-MENU JS -->
<script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

<!-- INTERNAL SELECT2 JS -->
<!-- <script src="../assets/plugins/select2/select2.full.min.js"></script> -->

<!-- DATA TABLE JS-->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/table-data.js') }}"></script>

<!-- CHARTJS JS -->
<script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/p-scroll/pscroll.js')}}"></script>

<!-- STICKY JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>

<!-- SELECT2 JS -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- FORM ELEMENTS JS -->
<script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>

<!-- FORMVALIDATION JS -->
<script src="{{ asset('assets/js/form-validation.js') }}"></script>

@yield('scripts')

<!-- COLOR THEME JS -->
<script src="{{asset('assets/js/themeColors.js')}}"></script>

<!-- CUSTOM JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>

<!-- <script>
    function getLastCTUNumber() {
        return 'CTU/2508/2023';
    }

    function generateCTUNumber() {
        const lastCTUNumber = getLastCTUNumber();
        const parts = lastCTUNumber.split('/');
        const lastNumberPart = parseInt(parts[1], 10);
        const newNumberPart = lastNumberPart + 1;
        const currentYear = new Date().getFullYear();
        const newCTUNumber = `CTU/${newNumberPart}/${currentYear}`;
        return newCTUNumber;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const ctuNumberInput = document.getElementById('ctu_number');
        ctuNumberInput.value = generateCTUNumber();
    });
</script> -->