<form action="{{ route('members.destroy', $member->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <a class="btn btn-sm btn-info" href="{{ route('members.show', $member->id) }}">Detail</a>
    <a class="btn btn-sm btn-primary" href="{{ route('members.edit', $member->id) }}">Ubah</a>
    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
</form>
