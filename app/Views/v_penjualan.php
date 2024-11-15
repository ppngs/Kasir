<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir Intechcom</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style type="text/css">
        .select2 {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .select2-search__field {
            margin-top: 0px !important;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="text-left mb-2">
                        <span class="text-danger"><a href="<?= base_url('Dashboard') ?>"><b>Tutup (esc)</b></a></span>
                    </div>
                    <div class="text-center mb-5">
                        <!-- <img src="<?= base_url('uploads/intechcom.jpg') ?>" alt="Logo" style="width: 75px; border-radius: 50px;"> -->
                        <h2><b>Kasir Intechcom</b></h2>
                    </div>

                    <!-- Total Display -->
                    <div class="col-md-12" autocomplete="off">
                        <div class="row">

                            <div class="col-md-7 row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>No. Faktur</label>
                                        <label class="form-control form-control-lg" id="no_faktur"><?= $no_faktur ?></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <label id="tanggal" class="form-control form-control-lg"></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Jam</label>
                                        <label id="jam" class="form-control form-control-lg"></label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Kasir</label>
                                        <label id="kasir" class="form-control form-control-lg"><?= session()->get('nama_user') ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card-body bg-black p-4 text-right">
                                    <label class="display-4 text-green"><span id="total_transaksi">0</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">

                        <!-- Input Form -->
                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-2">
                                    <div class="input-group ">
                                        <div class="input-group">
                                            <select id="kode_barang" name="kode_barang" class="form-control mb-2 select2" onchange="populateFields()" autocomplete="off">
                                                <option value="" disabled selected>Pilih Kode Barang</option> <!-- Placeholder -->
                                                <?php foreach ($produk as $item): ?>
                                                    <option
                                                        value="<?php echo $item['kode_produk']; ?>"
                                                        data-nama="<?php echo $item['nama_produk']; ?>"
                                                        data-harga="<?php echo $item['harga_jual']; ?>"
                                                        data-kategori="<?php echo $item['nama_kategori']; ?>"
                                                        data-satuan="<?php echo $item['nama_satuan']; ?>">
                                                        <?php echo $item['kode_produk'] . ' - ' . $item['nama_produk']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <input type="text" id="nama_barang" class="form-control" placeholder="Nama Barang" readonly>
                                </div>
                                <div class="col-md-1">
                                    <input class="form-control mb-2" placeholder="Kategori" id="kategori_barang" readonly>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control mb-2" placeholder="Satuan" id="satuan_barang" readonly>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" min="1" value="1" class="form-control mb-2" placeholder="Qty" id="qty_barang" onchange="updateTotal()">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control mb-2" placeholder="Harga" id="harga_barang" readonly>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control mb-2" placeholder="Total" id="total_barang" readonly>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success btn-flat mb-2" id="add-btn">
                                        <i class="fas fa-plus"></i> <!-- Ikon add -->
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tabel Barang -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3 class="card-title">Daftar Barang</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-bordered table-hover text-nowrap" id="product-table">
                                <thead>
                                    <tr class="text-center">
                                        <th style="position: sticky; top: 0; background-color: white;">Kode Barang</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Nama Barang</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Kategori</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Satuan</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Qty</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Harga</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Total</th>
                                        <th style="position: sticky; top: 0; background-color: white;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data produk akan ditambahkan disini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Pembayaran Section -->
                <div class="row">
                    <!-- Kolom Bayar -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bayar">Bayar</label>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning"><i class="fas fa-money-bill-wave"></i></span>
                                </div>
                                <input type="text" class="form-control bg-warning text-dark form-control-lg" id="bayar" placeholder="Masukkan jumlah bayar">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kembalian -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kembalian">Kembalian</label>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info"><i class="fas fa-exchange-alt"></i></span>
                                </div>
                                <input type="text" class="form-control bg-info text-white form-control-lg" id="kembalian" placeholder="Kembalian" readonly>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tombol Simpan Transaksi -->
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success btn-lg" onclick="submitPayment()">
                            <i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </div>


                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> AdminLTE, Inc.
                                <small class="float-right">Date: 2/10/2014</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Admin, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> 4F3S8J<br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> 968-34567
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>El snort testosterone trophy driving gloves handsome</td>
                                        <td>$64.50</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Need for Speed IV</td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Monsters DVD</td>
                                        <td>735-845-642</td>
                                        <td>Terry Richardson helvetica tousled street art master</td>
                                        <td>$10.70</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Grown Ups Blue Ray</td>
                                        <td>422-568-642</td>
                                        <td>Tousled lomo letterpress</td>
                                        <td>$25.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Amount Due 2/22/2014</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$250.30</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>$5.80</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$265.24</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Nota Intechcom -->
                <div class="modal fade" id="nota-modal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="notaModalLabel">Nota Pembayaran - Intechcom</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="nota-container">
                                <!-- Nota content -->
                                <div class="nota p-3 border rounded shadow-sm">
                                    <div class="nota-header mb-4">
                                        <h2 class="text-center mb-2">Nota Penjualan</h2>
                                        <p class="mb-1"><strong>No. Faktur:</strong> <span id="nota-no-faktur" class="text-muted"></span></p>
                                        <p class="mb-1"><strong>Tanggal:</strong> <span id="nota-tanggal" class="text-muted"></span></p>
                                        <p><strong>Jam:</strong> <span id="nota-jam" class="text-muted"></span></p>
                                    </div>
                                    <div class="nota-details mb-4">
                                        <p class="mb-2"><strong>Total:</strong> <span id="nota-total" class="text-primary"></span></p>
                                        <p class="mb-2"><strong>Bayar:</strong> <span id="nota-bayar" class="text-primary"></span></p>
                                        <p><strong>Kembalian:</strong> <span id="nota-kembalian" class="text-success"></span></p>
                                    </div>
                                    <div class="nota-footer text-center mt-4">
                                        <p class="font-italic">Terima kasih atas kunjungan Anda di Intechcom!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" onclick="printNota()">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- REQUIRED SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: "bootstrap",
                placeholder: "Kode Barang",
                autoClear: true
            });

        });

        function updateTime() {
            const now = new Date();
            const tanggal = now.toLocaleDateString('id-ID');
            const jam = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            document.getElementById('tanggal').textContent = tanggal;
            document.getElementById('jam').textContent = jam;
        }

        setInterval(updateTime, 1000); // Update setiap 1 detik

        function generateInvoiceNumber() {
            let lastInvoiceNumber = $('#no_faktur').text(); // Ambil nomor faktur terakhir
            let newNumber;

            if (lastInvoiceNumber) {
                // Ekstrak nomor urut
                let number = parseInt(lastInvoiceNumber.substring(2)); // Misal no faktur "IN0001"
                newNumber = number + 1; // Tambah 1
            } else {
                newNumber = 1; // Jika belum ada, mulai dari 1
            }

            // Format nomor faktur
            return 'IN' + String(newNumber).padStart(4, '0');
        }

        function populateFields() {
            const select = document.getElementById("kode_barang");
            const selectedOption = select.options[select.selectedIndex];

            document.getElementById("nama_barang").value = selectedOption.getAttribute("data-nama");
            document.getElementById("kategori_barang").value = selectedOption.getAttribute("data-kategori");
            document.getElementById("satuan_barang").value = selectedOption.getAttribute("data-satuan");
            document.getElementById("harga_barang").value = selectedOption.getAttribute("data-harga");

            updateTotal();
        }

        function updateTotal() {
            const harga = parseFloat(document.getElementById("harga_barang").value) || 0;
            const qty = parseInt(document.getElementById("qty_barang").value) || 1;
            const total = harga * qty;
            document.getElementById("total_barang").value = total;
        }
        // Fungsi untuk format angka menjadi Rupiah tanpa simbol
        function formatRupiah(nilai) {
            return new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0
            }).format(nilai);
        }

        // Fungsi untuk menambah barang ke tabel
        function tambahBarang() {
            const kodeBarang = $('#kode_barang').val();
            const namaBarang = $('#nama_barang').val();
            const kategoriBarang = $('#kategori_barang').val();
            const satuanBarang = $('#satuan_barang').val();
            const qtyBarang = parseInt($('#qty_barang').val(), 10);
            const hargaBarang = parseFloat($('#harga_barang').val());

            // Validasi input
            if (!kodeBarang || !namaBarang || !kategoriBarang || !satuanBarang || !qtyBarang || isNaN(hargaBarang)) {
                alert('Harap lengkapi semua input.');
                return;
            }

            // Cek apakah barang sudah ada di tabel
            const barisAda = $('#product-table tbody tr').filter(function() {
                return $(this).find('td:eq(0)').text() === kodeBarang;
            });

            if (barisAda.length > 0) {
                // Jika barang sudah ada, update quantity dan total
                const qtySaatIni = parseInt(barisAda.find('td:eq(4)').text(), 10);
                const qtyBaru = qtySaatIni + qtyBarang;
                const totalBaru = qtyBaru * hargaBarang;

                barisAda.find('td:eq(4)').text(qtyBaru);
                barisAda.find('td:eq(6)').text(totalBaru); // Format total barang dalam Rupiah
            } else {
                // Tambahkan baris baru ke tabel
                const totalBarang = qtyBarang * hargaBarang;
                const baris = `
            <tr>
                <td>${kodeBarang}</td>
                <td>${namaBarang}</td>
                <td>${kategoriBarang}</td>
                <td>${satuanBarang}</td>
                <td>${qtyBarang}</td>
                <td>@${hargaBarang}</td> 
                <td>${totalBarang}</td> 
                <td class="text-center"><button class="btn btn-danger btn-remove">Hapus</button></td>
            </tr>`;
                $('#product-table tbody').append(baris);
            }

            // Reset input setelah menambah barang
            resetInput();
            updateTotalTransaksi();
        }


        // Fungsi untuk mereset input
        function resetInput() {
            $('#kode_barang').val('').trigger('change'); // Reset select2 dan trigger perubahan
            $('#nama_barang, #kategori_barang, #satuan_barang, #harga_barang, #total_barang').val('');
            $('#qty_barang').val(1);
        }


        // Hapus item dari tabel
        $('#product-table').on('click', '.btn-remove', function() {
            $(this).closest('tr').remove();
            updateTotalTransaksi();
        });

        // Fungsi untuk menghitung total transaksi
        function updateTotalTransaksi() {
            let total = 0;
            $('#product-table tbody tr').each(function() {
                const totalBarang = parseFloat($(this).find('td:eq(6)').text().replace(/[^0-9.-]+/g, "")) || 0; // Mengambil angka dari format Rupiah
                total += totalBarang;
            });
            $('#total_transaksi').text(formatRupiah(total)); // Update total transaksi dengan format Rupiah
        }

        // Event listener untuk tombol tambah
        $('#add-btn').click(tambahBarang);

        $('#bayar').on('input', function() {
            const totalTransaksi = parseFloat($('#total_transaksi').text().replace(/\./g, '').replace(/,/g, '.')) || 0;
            const bayar = parseFloat($(this).val()) || 0;
            const kembalian = bayar - totalTransaksi;

            $('#kembalian').val(formatRupiah(kembalian));
        });

        function submitPayment() {
            const totalTransaksi = parseFloat($('#total_transaksi').text().replace(/\./g, '').replace(/,/g, '.')) || 0;
            const bayar = parseFloat($('#bayar').val()) || 0;
            const kembalian = bayar - totalTransaksi;

            // Memastikan pembayaran cukup
            if (bayar < totalTransaksi) {
                alert('Jumlah bayar tidak cukup.');
                return;
            }

            // Mengumpulkan data transaksi
            const transactionData = {
                no_faktur: "<?= $no_faktur ?>",
                tgl_jual: document.getElementById("tanggal").textContent,
                jam: document.getElementById("jam").textContent,
                total: totalTransaksi,
                bayar: bayar,
                kembalian: kembalian,


            };

            $.ajax({
                url: "<?= base_url('penjualan/simpan') ?>",
                type: "POST",
                data: transactionData,
                success: function(response) {
                    if (response.status === 'success') {
                        // Isi data nota ke dalam modal
                        $('#nota-no-faktur').text(response.no_faktur);
                        $('#nota-tanggal').text(new Date(response.tgl_jual).toLocaleDateString('id-ID'));
                        $('#nota-jam').text(response.jam);
                        $('#nota-total').text('Rp. ' + parseFloat(response.total).toLocaleString('id-ID'));
                        $('#nota-bayar').text('Rp. ' + parseFloat(response.bayar).toLocaleString('id-ID'));
                        $('#nota-kembalian').text('Rp. ' + parseFloat(response.kembalian).toLocaleString('id-ID'));

                        // Reset nomor faktur
                        $('#no_faktur').text(generateInvoiceNumber()); // Pastikan ID ini sesuai dengan elemen di HTML Anda

                        // Tampilkan modal
                        $('#nota-modal').modal('show');
                        $('#product-table tbody').empty();
                        $('#total_transaksi').text(formatRupiah(0));
                        $('#bayar').val('');
                        $('#kembalian').val('');
                    } else {
                        alert("Terjadi kesalahan, silakan coba lagi.");
                    }
                }
            });
        };





        function printNota() {
            var printContents = document.getElementById('nota-container').innerHTML;
            var newWindow = window.open('', '', 'width=600,height=400');
            newWindow.document.write('<html><head><title>Nota Penjualan</title>');
            newWindow.document.write('<link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/bootstrap/css/bootstrap.min.css">');
            newWindow.document.write('</head><body>');
            newWindow.document.write(printContents);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
</body>

</html>