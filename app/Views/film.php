<script src="https://drive.crazycode.my.id/datajs/film3.js"></script>

<div class="panel-header btn-default ">
    <div class="page-inner py-5 col-md-6 ml-auto mr-auto">
        <div col-md-6 ml-auto mr-auto>
            <div>
                <h2 class="text-white pb-2 fw-bold">Cari Film</h2>
                <div class="card-body">
                    <select class="form-control select2 select2-hidden-accessible" multiple="" id="tampiltahun"
                        data-placeholder="Tahun" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    </select>
                </div>
                <h5 class="text-white op-7 mb-2" id="jml" style="text-align:right;">Jumlah Film : 0</h5>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5" id="blokfilm" style="margin-left: 15px; margin-right: 15px;"></div>
<div class="modal fade" role="dialog" id="modaldetail" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="blokdetail"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    const ListYear = $.map(datafilm, function(obj) {
        var str = obj.data[1]['Tahun'];
        var arr = str.split(", ");
        return arr;
    });
    const year = ListYear.filter((value, index, self) => {
        return self.indexOf(value) === index;
    });
    var ops = '';
    $.each(year, function(index, value) {
        $('#tampiltahun').append($('<option></option>').attr('value', value).text(value));

    });


    $("#tampiltahun").change(function() {
        datafilms = [];
        choices = $("#tampiltahun").val();
        $.each(choices, function(index, value) {
            $.map(datafilm, function(obj) {
                var str = obj.data[1]['Tahun'];
                var arr = str.split(", ");
                var chk = $.inArray(value, arr);
                if (chk > -1) {
                    datafilms.push(obj);
                };
            });
        });
        ListFilem = unique(datafilms);
        ambildatafilm(ListFilem);
        $('#jml').html('Jumlah Film : ' + ListFilem.length);
    });

});

function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}

function ambildatafilm(array) {
    let hasil = "";
    let x;
    for (x in array) {
        let cv = array[x].Sampul;
        let jd = array[x].data[0].Judul;
        let pm = array[x].data[0].Pemain;
        let th = array[x].data[1].Tahun;
        let rt = array[x].data[1].Rating;
        let sn = array[x].data[0].Sinopsis;
        let dr = array[x].data[1].Durasi;
        let tr = array[x].Trailer;
        hasil += "<img src='" + cv + "' data-trailers='" + tr + "' data-judul='" + jd + "' data-pemain='" + pm +
            "' data-tahun='" + th +
            "' data-rating='" + rt + "' data-durasi='" + dr + "' data-sinopsis='" + sn +
            "' class='col-md-2' style='margin-bottom: 15px;' onclick='tampildetail(this)'> ";
    }
    $("#blokfilm").html(hasil);
}
ambildatafilm();

function tampildetail(el) {
    let judul = $(el).data("judul");
    let pemain = $(el).data("pemain");
    let tahun = $(el).data("tahun");
    let rating = $(el).data("rating");
    let sinopsis = $(el).data("sinopsis");
    let trailers = $(el).data("trailers");
    let durasi = $(el).data("durasi");
    $("#blokdetail").html("<iframe width='100%' src='" + trailers.replace('youtu.be/',
            'www.youtube.com/embed/') + "' allowfullscreen></iframe>" +
        "<p style='font-size: 20px;'><b>Judul:</b><br>" + judul +
        "<p style='font-size: 20 px;'><b>Pemain: </b><br>" + pemain +
        "<p style='font-size: 20 px;'><b>Tahun: </b><br>" + tahun +
        "<p style='font-size: 20 px;'><b>Rating: </b><br>" + rating +
        "<p style='font-size: 20 px;'><b>Durasi: </b><br>" + durasi +
        "<p style='font-size: 20 px; text-align:justify'><b>Sinopsis:</b><br>" + sinopsis);
    $("#modaldetail").modal("show");

}


$(document).ready(function() {
    $('.select2').select2({
        closeOnSelect: false
    });
});
</script>