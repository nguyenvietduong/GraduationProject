(function ($) {
    "use strict"
    var PMD = {}

    PMD.getAllPermission = async () => {
        try {
            const res = await $.ajax({
                url: '/admin/permission/ajaxGetPermission',
                type: 'GET',
                dataType: 'json'
            });
            return res.data.permissions
        } catch (error) {
            console.log('Lỗi: ', error);
            throw error
        }
    }


    PMD.checkPermissionMenu = async () => {
        let data = await PMD.getAllPermission()
        $('.checkPermissionMenu').each(function () {
            let hrefValue = $(this).find('a').attr('href');

            let parts = hrefValue.split('/');
            let lastTwoParts = parts.slice(-2).join('/');

            lastTwoParts = lastTwoParts.replace(/\//g, '.');

            if (!data.some(item => item.slug === lastTwoParts.trim())) {
                $(this).css('display', 'none'); // Ẩn phần tử nếu không tìm thấy
            }
        });
    }



    PMD.int = () => {
        $(document).on('change keyup blur', '.int', function () {
            let _this = $(this)
            let value = _this.val()
            if (value === '') {
                $(this).val('0')
            }
            value = value.replace(/\./gi, "")
            _this.val(PMD.addCommas(value))
            // if (isNaN(value)) {
            //     _this.val('0')
            // }
        })

    }

    PMD.addCommas = (nStr) => {
        nStr = String(nStr)
        nStr = nStr.replace(/\./gi, "")
        let str = ''
        for (let i = nStr.length; i > 0; i -= 3) {
            let a = ((i - 3) < 0) ? 0 : (i - 3)
            str = nStr.slice(a, i) + ',' + str
        }
        str = str.slice(0, str.length - 1)
        return str
    }

    PMD.formatUppercase = () => {
        $(document).on('input', '.uppercase', function () {
            let _this = $(this)
            _this.val(_this.val().toUpperCase())
        })
    }

    $(document).ready(function () {
        PMD.int()
        PMD.addCommas()
        PMD.formatUppercase()
        // PMD.checkPermissionMenu()
    })

})(jQuery)
