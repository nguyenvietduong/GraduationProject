(function ($) {
    "use strict";
    var PMD = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    PMD.changeStatus = () => {
        $(document).on('change', '.statusPromotion', function (e) {
            let _this = $(this)
            let option = {
                'value': _this.val(),
                'dataPromotion': _this.attr('data-promotion'),
                '_token': _token
            }

            $.ajax({
                url: '/admin/promotion/updateStatus',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function (res) {
                    let text = _this.find('option:selected').text()
                    PMD.renderHTMLUpdateAt(res)
                    PMD.renderHTMLToModal(text, option.dataPromotion)
                    executeExample('success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });

            e.preventDefault()
        })
    }

    PMD.renderHTMLUpdateAt = (res) => {
        if (res) {
            let textContent = res.updateTime

            $('.updatePromotion').empty()
            let html = `
            <span>${textContent}</span>
            `

            $('.updatePromotion').append(html);
        }
    }


    PMD.renderHTMLToModal = (text, id) => {

        console.log(text);
        let modalPromotion = $('.modalPromotion_' + id)
        console.log(modalPromotion);
        // let idModalPromotion = modalPromotion.attr("data-modal-promotion")
        modalPromotion.empty()

        let html = `
        <option value="">${text}</option>
        `

        modalPromotion.append(html);
    }

    $(document).ready(function () {
        PMD.changeStatus()
        PMD.renderHTMLUpdateAt()
        // PMD.renderHTMLToModal()
    });

})(jQuery);
