  $(document).ready(function(){

    $('#table-daftar-pelamar').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
        { extend: 'copy'},
        {extend: 'csv'},
        {extend: 'excel', title: 'daftarPelamar'},
        {extend: 'pdf', title: 'daftarPelamar'},

        {extend: 'print',
        customize: function (win){
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');

            $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
        }
    }
    ]

});

  $('#table-belum-persetujuan').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
        { extend: 'copy'},
        {extend: 'csv'},
        {extend: 'excel', title: 'daftarPelamar'},
        {extend: 'pdf', title: 'daftarPelamar'},

        {extend: 'print',
        customize: function (win){
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');

            $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
        }
    }
    ]

});

});

