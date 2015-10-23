$(function() {
    $("input[name='trefwoord']").autocomplete({
        source: "controllers/search.php",
        minLength: 2,
        open: function (e, ui) {
            var acData = $(this).data('autocomplete');
            acData
                .menu
                .element
                .find('a')
                .each(function () {
                    var me = $(this);
                    var keywords = acData.term.split(' ').join('|');
                    me.html(me.text().replace(new RegExp("(" + keywords + ")", "gi"), '<span class="search_results">$1</span>'));
                });
        }
    });
});
