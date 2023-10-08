@extends('layouts.main')

@section('container')

<div class="row row-sm">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">{{ $title }}</h4>
					<div>
						<a class="btn btn-info btn-sm" href="{{ route('uang-keluar.edit', $uang_keluar->slug) }}">
							<i class="fas fa-pencil-alt"></i>
							Edit
						</a>
						<form action="{{ route('uang-keluar.destroy', $uang_keluar->slug) }}" method="post" class="d-inline">
							@method('delete')
							@csrf
							<button class="btn btn-danger btn-sm" id='deleteData' data-title="{{ $uang_keluar->slug }}">
								<i class="fas fa-trash"></i>
								Delete
							</button>
						</form>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table mg-b-0 text-md-nowrap border-bottom">
						<tr>
							<th>Tanggal Input:</th>
							<td style="width: 90%">{{ $uang_keluar->created_at->format('d F Y') }}</td>
						</tr>
						<tr>
							<th>Tanggal Uang Keluar:</th>
							<td style="width: 90%">{{ $uang_keluar->tgl_saldo->format('d F Y') }}</td>
						</tr>
						<tr>
							<th>Keterangan:</th>
							<td style="width: 90%">{{ $uang_keluar->keterangan }}</td>
						</tr>
						<tr>
							<th>Saldo:</th>
							<td style="width: 90%">{{ number_format($uang_keluar->saldo, 0, ',', '.') }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

<!-- JQuery min js -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>

<!-- Sweet-alert js  -->
<script src="/assets/plugins/sweet-alert/sweetalert2.all.min.js"></script>

<script>
	$(document).ready(function() {
		$('#deleteData').click(function(e) {
			e.preventDefault();
			var title = $(this).data('title');
			
			Swal.fire({
				title: 'Hapus ' + title + '?',
				html: "Apakah kamu yakin ingin menghapus <b>" + title + "</b>? Data yang sudah dihapus tidak bisa dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$(this).closest('form').submit();
				}
			});
		});
	});
</script>

<!-- Bootstrap Bundle js -->
<script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Moment js -->
<script src="/assets/plugins/moment/moment.js"></script>

<!-- Eva-icons js -->
<script src="/assets/js/eva-icons.min.js"></script>

<!-- P-scroll js -->
<script src="/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

<!-- Sticky js -->
<script src="/assets/js/sticky.js"></script>

<!-- Rating js-->
<script src="/assets/plugins/ratings-2/jquery.star-rating.js"></script>
<script src="/assets/plugins/ratings-2/star-rating.js"></script>

<!-- Sidebar js -->
<script src="/assets/plugins/side-menu/sidemenu.js"></script>

<!-- Right-sidebar js -->
<script src="/assets/plugins/sidebar/sidebar.js"></script>
<script src="/assets/plugins/sidebar/sidebar-custom.js"></script>

<!-- eva-icons js -->
<script src="/assets/js/eva-icons.min.js"></script>

<!--themecolor js-->
<script src="/assets/js/themecolor.js"></script>

<!-- custom js -->
<script src="/assets/js/custom.js"></script>

@endsection