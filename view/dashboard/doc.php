<style>
    .card {
        transition: all 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.1);
    }

    .card:hover h5 {
        /* fallback for old browsers */
        color: #fe9100;

        /* Chrome 10-25, Safari 5.1-6 */
        color: -webkit-linear-gradient(to right, #fdb04c, #fe9100);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        color: linear-gradient(to bottom, #fdb04c, #fe9100);
    }
    .card:hover img {
        /* fallback for old browsers */
        background: #000;
        padding: 10px 10px;
    }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">หนังสือ</li>
    </ol>
</nav>
<hr>

<div class="container bg-secondary-addpay rounded-5">
    <div class="main-body p-md-5 text-white">
        <div class="container">
            <div class="row py-5">
                <div class="col-12 col-md-6 px-5 mb-3">
                    <a href="?page=doc_in" class="text-decoration-none doc-hover">
                        <div class="card text-center border-0 bg-transparent h-100">
                            <div class="card-body">
                                <img src="image/doc-in.png" class="card-img-top w-50 rounded-5" alt="...">
                            </div>
                            <div class="card-footer text-white bg-transparent border-0">
                                <h5>หนังสือ-เข้า</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-6 px-5 mb-3">
                    <a href="?page=doc_out" class="text-decoration-none doc-hover">
                        <div class="card text-center border-0 bg-transparent h-100">
                            <div class="card-body">
                                <img src="image/doc-out.png" class="card-img-top w-50 rounded-5" alt="...">
                            </div>
                            <div class="card-footer text-white bg-transparent border-0">
                                <h5>หนังสือ-ออก</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>