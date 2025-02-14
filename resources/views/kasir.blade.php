<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Musaba</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <style>
        .btn-orange {
            background-color: #fd7e14;
            color: white;
        }

        .btn-orange:hover {
            background-color: #f17012;
            color: white;
        }
    </style>

</head>

<body class="bg-light">
    <div class="container-fluid p-4">
        {{-- logo aplikasi --}}
        <div class="row">
            <div class="col-2">
                <a class="sidebar-brand d-flex" href="/">
                    <img src="/img/logokasir.jpg">
                </a>
            </div>
            <div class="col-9">
                <marquee direction='left' scrolldelay='150' class="pt-3" mt-2>
                    <h4>Aplikasi Kasir Hasil Karya Siswa - Siswi SMK Muhammadiyah 1 Bantul Program Keahlian Pemrograman
                        Perangkat Lunak dan Gim (PPLG)</h4>
                </marquee>
            </div>
            <div class="col-1 text-right">
                <a href="/"><button class="btn btn-danger p-2 col-12 mt-2">Keluar</button></a>
            </div>
        </div>


        <!-- Transaction Info -->
        <div class="row p-3">
            <div class="card col-4 border-primary">
                <div class="row">
                    <div class="form-group col-4">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                            value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label>No. Nota</label>
                        <input type="text" class="form-control" id="nota" value="{{ $NoNota }}" readonly>
                    </div>

                </div>

            </div>
            <div class="col-3">

            </div>
            <div class="card col-5 border-primary text-center">
                <h4>Total Belanja</h4>

                <h1 class="text-danger" id="totalBelanja">Rp. 0</h1>
            </div>
        </div>


        <!-- Barcode Input -->
        <div class="form-group mb-4">
            <form onsubmit="">
                <input type="text" class="form-control" name="barcode"
                    placeholder="Ketik kode kemudian tekan ENTER pd keyboard, atau scan barcode" autofocus>
            </form>
        </div>

        <!-- Products Table -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        {{-- <th>Diskon</th> --}}
                        <th>Jumlah</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody id="products">
                    {{-- @foreach ($produks as $produk)
                        <tr>
                            <td>{{ $produk->KodeProduk }}</td>
                            <td>{{ $produk->KodeProduk }}</td>
                            <td>Rp. {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex">
                                    <input type="number" class="form-control mr-2" value="1" style="width: 70px">
                                </div>
                            </td>
                            <td>Rp. {{ number_format($produk->Harga * 1, 0, ',', '.') }}</td>
                            <td><button class="btn btn-danger btn-sm">Hapus</button></td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->


        <!-- Summary -->
        <div class="row">
            <div class="col-8">

            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Grandtotal</span>
                            <span id="grandTotal">Rp. 0</span>
                        </div>

                        <div class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Dibayar</span>
                            <input class="form-control p-1 col-6" name="dibayar" id="dibayar">
                        </div>
                        <div class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Pelanggan</span>
                            <select class="form-control p-1 col-6" name="pelanggan" id="pelanggan" required>
                                <option value="">Pilih Pelanggan</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->NamaPelanggan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Kembalian</span>
                            <span id="change">Rp. 0</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-orange" id="reset">Reset Form</button>

                    <button class="btn btn-success" id="tombolsimpan">Simpan Transaksi</button>


                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('kasir.simpan') }}">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header bg-success">
                        <h4 class="modal-title text-white">Rincian Belanja</h4>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label>Tanggal</label>
                            </div>
                            <div class="col-8">
                                : <span id="simpantanggal"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Total Belanja</label>
                            </div>
                            <div class="col-8">
                                : <span id="totalbayar"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Jumlah Uang</label>
                            </div>
                            <div class="col-8">
                                : <span id="jumlahuang"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Kembalian</label>
                            </div>
                            <div class="col-8">
                                : <span id="simpankembalian"></span>
                            </div>
                        </div>


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form action="/kasir/simpan" method="POST">
                            @csrf
                            <input type="hidden" name="kasirtanggal" id="kasir-tanggal" value="">
                            <input type="hidden" name="kasirnota" id="kasir-nota" value="">
                            <input type="hidden" name="kasiridpelanggan" id="kasir-idpelanggan" value="">
                            <input type="hidden" name="kasirtotal" id="kasir-total" value="">
                            <input type="hidden" name="kasirbayar" id="kasir-bayar" value="">
                            <input type="hidden" name="kasirkembalian" id="kasir-kembalian" value="">
                            <input type="hidden" name="kasirproduk" id="kasir-produk" value="">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    <script>
        // Focus to barcode input
        document.querySelector('input[name="barcode"]').focus();

        // Log products from localStorage
        const tbody = document.querySelector('#products');
        let products = JSON.parse(localStorage.getItem('products')) || [];
        renderProducts(products);

        function renderProducts(products) {
            const tbody = document.querySelector('#products');
            const grandTotal = products.reduce((acc, product) => acc + (product.harga * product.qty), 0);
            document.querySelector('#grandTotal').textContent = 'Rp. ' + grandTotal.toLocaleString();
            document.querySelector('#totalBelanja').textContent = 'Rp. ' + grandTotal.toLocaleString();
            const dibayarInput = document.querySelector('input[name="dibayar"]');
            dibayarInput.addEventListener('input', function() {
                const dibayar = parseFloat(dibayarInput.value) || 0;
                document.querySelector('#change').textContent = ((dibayar - grandTotal) < 0 ? 'Kurang!' : 'Rp. ' + (
                    dibayar - grandTotal).toLocaleString());
            });

            tbody.innerHTML = ''; // Clear existing rows
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${product.kode}</td>
                <td>${product.nama}</td>
                <td>Rp. ${product.harga.toLocaleString()}</td>
                <td>
                <div class="d-flex">
                    <input type="number" class="form-control mr-2" value="${product.qty}" min="1" style="width: 70px" onchange="updateQty('${product.kode}', this.value)">
                </div>
                </td>
                <td>Rp. ${(product.harga * product.qty).toLocaleString()}</td>
                <td><button class="btn btn-danger btn-sm">Hapus</button></td>
            `;
                tbody.appendChild(row);
                row.querySelector('button').addEventListener('click', function() {
                    const index = products.findIndex(p => p.kode === product.kode);
                    if (index !== -1) {
                        products.splice(index, 1);
                        localStorage.setItem('products', JSON.stringify(products));
                        renderProducts(products);
                    }
                });

            });
        }

        // Reset form
        document.querySelector('#reset').addEventListener('click', function() {
            products = [];
            localStorage.setItem('products', JSON.stringify(products));
            renderProducts(products);
            document.querySelector('input[name="barcode"]').value = '';
            document.querySelector('input[name="dibayar"]').value = '';
            document.querySelector('#change').textContent = 'Rp. 0';
            document.querySelector('input[name="barcode"]').focus();
        });

        // TODO: SUBMIT FORM

        function updateQty(kode, qty) {
            const index = products.findIndex(p => p.kode === kode);
            if (index !== -1) {
                products[index].qty = parseInt(qty);
                localStorage.setItem('products', JSON.stringify(products));
                renderProducts(products);
            }
        }
        // Handle form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const barcode = document.querySelector('input[name="barcode"]').value;
            const produk = @json($produks).find(p => p.KodeProduk === barcode);
            if (produk) {
                const existingProduct = products.find(p => p.kode === produk.KodeProduk);
                if (existingProduct) {
                    existingProduct.qty += 1;
                } else {
                    products.push({
                        id: produk.id,
                        kode: produk.KodeProduk,
                        nama: produk.NamaProduk,
                        harga: produk.Harga,
                        qty: 1
                    });
                }
                localStorage.setItem('products', JSON.stringify(products));
                renderProducts(products);
            } else {
                alert('Produk tidak ditemukan');
            }
            // alert('Form submitted with barcode: ' + barcode);
            document.querySelector('input[name="barcode"]').value = '';
        });

        function hapusformat($nominal) {

            $nilai = preg_replace('/[Rp. ]/', '', $nominal);
            return $nilai;
        }
        $(document).ready(function() {
            $('#tombolsimpan').on('click', function() {

                var pelanggan = document.getElementById("pelanggan").value;
                var dibayar = document.getElementById("dibayar").value;
                if (pelanggan.trim() === "" || dibayar.trim() === "") {
                    alert("Input Pelanggan dan Dibayar tidak boleh kosong!");
                } else {

                    $('#myModal').modal('show');
                    var nota = document.querySelector('#nota').value
                    var totalbayar = document.querySelector('#grandTotal').textContent
                    var pelanggan = document.querySelector('#pelanggan').value
                    var tanggal = document.querySelector('input[name="tanggal"]').value
                    var dibayar = document.querySelector('input[name="dibayar"]').value
                    var kembalian = document.querySelector('#change').textContent

                    document.getElementById('totalbayar').textContent = totalbayar;
                    document.getElementById('simpantanggal').textContent = tanggal;
                    document.getElementById('jumlahuang').textContent = 'Rp. ' + dibayar;
                    document.getElementById('simpankembalian').textContent = kembalian;

                    document.getElementById('kasir-tanggal').value = tanggal;
                    document.getElementById('kasir-idpelanggan').value = pelanggan;
                    document.getElementById('kasir-nota').value = nota;
                    document.getElementById('kasir-total').value = totalbayar;
                    document.getElementById('kasir-bayar').value = dibayar;
                    document.getElementById('kasir-kembalian').value = kembalian;
                    document.getElementById('kasir-produk').value = JSON.stringify(products);

                }
            });

        });
    </script>
    <script>
        //message with toastr
        @if (session()->has('success'))
            alert('Transaksi Berhasil Disimpan');
            products = [];
            localStorage.setItem('products', JSON.stringify(products));
            renderProducts(products);
            document.querySelector('input[name="barcode"]').value = '';
            document.querySelector('input[name="dibayar"]').value = '';
            document.querySelector('#change').textContent = 'Rp. 0';
            document.querySelector('input[name="barcode"]').focus();
        @elseif (session()->has('error'))

            alert('Transaksi Gagal');
        @endif
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap 4 JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
