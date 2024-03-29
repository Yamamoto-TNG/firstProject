$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") }
    });

    const $searchButton = $('.js-search-btn');
    const $deleteButton = $('.js-delete-btn');
    $('.js-search-tablesort').tablesorter({
        headers: {
            '.js-btn-new': { sorter: false }
        }
     });

    $searchButton.on("click", function () {
        // 処理内容
        $('.js-tbody').empty();
        const keyword = $(".js-search-keyword").val();
        const companyId = $(".js-search-company-id").val();
        const lowerPrice = $(".js-search-lower-price").val();
        const upperPrice = $(".js-search-upper-price").val();
        const lowerStock = $(".js-search-lower-stock").val();
        const upperStock = $(".js-search-upper-stock").val();

        $.ajax({
            type: 'GET',
            url: 'search',
            data: {
                //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
                'keyword' : keyword,
                'company_id': companyId,
                'lower_price' : lowerPrice,
                'upper_price' : upperPrice,
                'lower_stock' : lowerStock,
                'upper_stock' : upperStock
            },
            dataType: 'json',
        })
        .done((data) => {
                for(let i in data) {
                    //会社名の取得
                    $.ajax({
                        type: 'GET',
                        url: `getCompanyName/${data[i].company_id}`,
                        dataType: 'json',
                    })
                    .done((companyData) => {
                        html = `
                            <tr class= "list">
                                <td>${data[i].id}</td>
                                <td><img src=${data[i].img_path} alt=${data[i].product_name}
                                width="100" height="100" class="img-thumbnail"></td>
                                <td>${data[i].product_name}</td>
                                <td>${data[i].price}</td>
                                <td>${data[i].stock}</td>
                                <td>${companyData.company_name}</td>
                                <div class="d-flex">
                                <td><a class="btn btn-outline-warning btn-sm" href="/firstProject/public/detail/${data[i].id}">詳細</a>
                                <button type="button" class="ms-2 btn btn-outline-danger btn-sm js-delete-btn" data-product-id="${data[i].id}" data-product-name="${data[i].product_name}">削除</button></td>
                                </div>
                                
                                </tr>
                        `;
                        $('.js-tbody').append(html);
                        $(".js-search-tablesort").trigger("update");
                    })
                    .fail( () => {
                        console.log('failure');
                    });
                }
            })
             .fail( () => {
                console.log('failure');
            })
    });

    $('body').on("click", '.js-delete-btn', function (e) {
        const $this = $(this);
        const productName = $this.attr('data-product-name');
        const productId = $this.attr('data-product-id');

        if (window.confirm(`【${productName}】を削除してよろしいでしょうか？`)) {

    $.ajax({
        type: 'post',
        url: 'delete/' + productId,
    })

    .done(function() {
        // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
        $this.parents('tr').remove();
    })

    .fail(function() {
        alert('エラー');
    });

    } else {
        e.preventDefault();
    }

    })
});
