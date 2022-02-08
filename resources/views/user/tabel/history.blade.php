<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pemesanan</th>
                <th>Pengiriman</th>
                <th>Tanggal Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sele as $sele)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sele->id }}</td>
                    <td>{{ $sele->pengiriman }}</td>
                    <td>{{ $sele->created_at->isoFormat('D MMMM Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
