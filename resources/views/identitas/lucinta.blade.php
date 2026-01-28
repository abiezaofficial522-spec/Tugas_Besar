<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <img src="https://i.pinimg.com/1200x/7b/dd/0e/7bdd0eb9ece70c2ddb564dabfb65df5d.jpg" alt="Foto Profil Jule" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <h1 class="card-title mb-4">Data Diri</h1>
                        <p class="text-start"><strong>Nama:</strong> Lucinta Luna</p>
                        <p class="text-start"><strong>Usia:</strong> 25 tahun</p>
                        <p class="text-start"><strong>Alamat:</strong> Jl. Melati</p>
                        <p class="text-start"><strong>Pekerjaan:</strong> Selebgram</p>
                        <p class="text-start"><strong>Hobi:</strong> Nonton drama</p>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <a href="{{ url('/') }}" class="btn btn-success btn-lg">Kembali</a>
                    <a href="{{ route('order', 2) }}" class="btn btn-primary btn-lg">Order Now</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
