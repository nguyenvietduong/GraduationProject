(function ($) {
    "use strict";
    var PMD = {};


    PMD.changeTypePromotion = () => {
        $(document).on('change', '.selectPromotion', function () {
            let value = $(this).find('option:selected').text()
            let input = $('.inputDiscount')
            $('.typePromotion').html(value)
            input.val('')
        })
    }


    PMD.randomCodePromotion = () => {
        $(document).on('click', '.randomCodePromotion', function () {
            let codePromotion = PMD.generateRandomCode()
            let inputCodePromotion = $('.inputCodePromotion')
            inputCodePromotion.val(codePromotion)
        })
    }


    PMD.checkTypePercent = () => {
        $('.inputDiscount').on('paste', function (e) {
            // Ngăn không cho dán nội dung vào ô input
            e.preventDefault();
        });

        $(document).on('input paste', '.inputDiscount', function () {
            let type = $('.selectPromotion').val()
            let value = $(this).val()
            if (type == 'percentage') {
                if (value > 100) {
                    $(this).val(100); // Nếu giá trị lớn hơn 100, đặt lại thành 100
                }
            }
        })
    }


    PMD.generateRandomCode = (minLength = 8, maxLength = 12, minDigits = 2, maxDigits = 4) => {
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const digits = '0123456789';

        // Chọn chiều dài ngẫu nhiên cho đoạn mã
        const length = Math.floor(Math.random() * (maxLength - minLength + 1)) + minLength;

        const digitCount = Math.min(Math.floor(Math.random() * (maxDigits - minDigits + 1)) + minDigits, length);
        const letterCount = length - digitCount; // Số ký tự chữ còn lại

        let code = '';

        for (let i = 0; i < digitCount; i++) {
            code += digits.charAt(Math.floor(Math.random() * digits.length));
        }

        for (let i = 0; i < letterCount; i++) {
            code += letters.charAt(Math.floor(Math.random() * letters.length));
        }

        code = code.split('').sort(() => 0.5 - Math.random()).join('');

        return code;
    }


    $(document).ready(function () {
        PMD.changeTypePromotion()
        PMD.checkTypePercent()
        PMD.randomCodePromotion()
    });

})(jQuery);
