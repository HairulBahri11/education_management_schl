<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Bootstrap CSS with cdn -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Cetak Kartu</title>
    <style>
        @page { size: auto;  margin: 0mm; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="prfil d-flex justify-content-center align-items-center">
                            <img src="{{ asset('storage/images/' . $data->foto) }}"
                                class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 60px; height: 60px; object-fit: cover; object-position: center  }}"
                                alt="">
                        </div>
                        <p class="card-text text-secondary text-center fw-bold mt-2">
                            {{ $data->nama_siswa }}</p>
                        </p>
                        <div class="qr d-flex justify-content-center align-items-center ">
                            <p>{!! QrCode::size(70)->generate($data->kode_siswa) !!}</p>
                        </div>
                        <p class=" text-secondary text-center">
                            <img src="{{ asset('logo.png') }}" class="img-fluid"
                                style="width: 40px; height: 30px" alt="">
                            Student Center
                        </p>
                        <p class="text-secondary text-center" style="font-size: 12px">Jln.
                            Manggasari Probolinggo Jawa Timur </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
