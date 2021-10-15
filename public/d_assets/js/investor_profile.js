$(()=>{
    $('#editBasicBtn').on('click', (e) => {
        $('#basicModal').modal({ backdrop: 'static', keyboard: false }, 'show');
    });

    $('#editBankBtn').on('click', (e) => {
        $('#bankModal').modal({ backdrop: 'static', keyboard: false }, 'show');
    });
    $('#editNokBtn').on('click', (e) => {
        $('#nokModal').modal({ backdrop: 'static', keyboard: false }, 'show');
    });
});