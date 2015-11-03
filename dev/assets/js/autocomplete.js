$(function() {
    $("input[name='q']").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "controllers/search.php",
                dataType: "json",
                data: { term: request.term },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { label: item.branche + " > " + item.subbranche, value: item.branche + " > " + item.subbranche, branche: item.branche, subbranche: item.subbranche }
                    }))
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            $("input[name='q']").val(ui.item.value);
            $("input[name='branche']").val(ui.item.branche);
            $("input[name='subbranche']").val(ui.item.subbranche);
            $("#opnaam").submit();
        },
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
