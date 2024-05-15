<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        background-color: #F5F5DC;
    }

    button {
        width: 150px;
        height: 45px;
        background-color: #FFB000;
        border-radius: 30px;
        margin-top: 40px;
        margin-left: 150px;
        outline: none;
        border: none;
    }

    .page {
        font-family: 'Poppins', sans-serif;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .page img {
        margin-top: 40px;
        margin-bottom: 40px;
        width: 450px;
    }

    .page p {
        color: #00422580;
        width: 800px;
    }

    .container-form {
        display: flex;
        flex-direction: column;
    }

    .input {
        display: flex;
        flex-direction: column;
        margin-bottom: 50px;
        color: black;
    }

    input {
        border-radius: 8px;
        background-color: #9EB384;
    }

    textarea {
        border-radius: 8px;
        background-color: #9EB384;
        padding-left: 10px;
        padding-top: 10px;
    }

    #topik {
        width: 1000px;
        height: 40px;
    }

    #judul {
        width: 1000px;
        height: 40px;
    }

    #gambar {
        background-color: #9EB384;
        height: 60px;
    }

    #teks {
        width: 1000px;
        height: 100px;
    }

    form {
        display: flex;
        align-items: center;
    }
    /* textarea */
    input[type="text"] {
        padding: 10px;
    }
    /* choose file */
    input[type="file"] {
        position: relative;
        padding-top: 12px;
        padding-left: 16px;
        border-radius: 10px;
        background-color: #fff;
    }

    input[type="file"]::file-selector-button {
        border: 0px solid;
        border-radius: 8px;
        padding: 6px;
        background-color: #CFE3BE;
        transition: 1s;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: #CFE3BE;
    }
</style>

<body>
    <section class="font-poppins">
        @foreach ($edukasis as $edukasi)
        @if ($edukasi->id_topik == 1)
        <a href="/admin/tanamtembakau">
            <div class="container">
                <button>Kembali</button>
            </div>
        </a>
        @break <!-- Hentikan loop setelah menemukan satu tautan yang sesuai -->
        @elseif ($edukasi->id_topik == 2)
        <a href="/admin/eksportembakau">
            <div class="container">
                <button>Kembali</button>
            </div>
        </a>
        @break <!-- Hentikan loop setelah menemukan satu tautan yang sesuai -->
        @endif
        @endforeach

        <div class="page">
            <form method="POST" action="{{ route('membuatedukasi') }}" enctype="multipart/form-data">
                @csrf
                <div class="container-form">
                    <div class="input">
                        <label for="topik">Topik Edukasi:</label>
                        <input type="text" name="id_topik" id="topik" value="{{ $id_topik }}" readonly>
                    </div>

                    <div class="input">
                        <label for="judul">Judul Edukasi:</label>
                        <input type="text" name="judul_edukasi" id="judul">
                    </div>

                    <div class="input">
                        <label for="gambar">Gambar Edukasi:</label>
                        <input type="file" name="gambar_edukasi" id="gambar" accept="image/*">
                    </div>

                    <div class="input">
                        <label for="teks">Teks Edukasi:</label>
                        <textarea name="teks_edu" id="teks"></textarea>
                    </div>

                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>