<div class="table-responsive">
    <table class="table table-bordered" id="dataSuper" width="100%" cellspacing="0">
        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dats as $a)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td><button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{$a->id}}" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                                <div class="modal fade" id="exampleModalCenter-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Akun</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('hapusakun', ['id' => $a->id])}}" enctype="multipart/form-data">
                                            @csrf
                                            <span>Anda yakin menghapus user ini ?</span><br>
                                            {{-- <input type="hidden" name="id" id="id" value="{{$a->id}}"> --}}
                                        </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>