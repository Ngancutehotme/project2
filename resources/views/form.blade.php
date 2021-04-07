<form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	chon file
	<input type="file" name="anh">
	<button>OK</button>
</form>