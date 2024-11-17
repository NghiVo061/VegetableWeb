(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow').css('top', 0);
            } else {
                $('.fixed-top').removeClass('shadow').css('top', 0);
            }
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        }
    });


    // vegetable carousel
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });


    // Modal Video
    $(document).ready(function () {

        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });

    $('.quantity button').on('click', function () {
        let change = 0;

        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        const input = button.parent().parent().find('input');
        const quantity1 = input.attr("quantity1")
        if (button.hasClass('btn-plus')) {
            if (oldValue < quantity1 - 1) {
                var newVal = parseFloat(oldValue) + 1;
                change = 1;
            }
            else
                newVal = quantity1 - 1;

        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
                change = -1;
            } else {
                newVal = 1;
            }
        }

        input.val(newVal);
        const index = input.attr("data-cart-detail-index")
        const el = document.getElementById(`quantity${index}`);
        $(el).val(newVal);

        const price = input.attr("data-cart-detail-price");
        const id = input.attr("data-cart-detail-id");

        const priceElement = $(`p[data-cart-detail-id='${id}']`);
        if (priceElement) {
            const newPrice = +price * newVal;
            priceElement.text(formatCurrency(newPrice.toFixed(2)) + " đ");
        }


        const totalPriceElement = $(`p[data-cart-total-price]`);

        if (totalPriceElement && totalPriceElement.length) {
            const currentTotal = totalPriceElement.first().attr("data-cart-total-price");
            let newTotal = +currentTotal;
            if (change === 0) {
                newTotal = +currentTotal;
            } else {
                newTotal = change * (+price) + (+currentTotal);
            }


            change = 0;

            //update
            totalPriceElement?.each(function (index, element) {
                $(totalPriceElement[index]).text(formatCurrency(newTotal.toFixed(2)) + " đ");
                $(totalPriceElement[index]).attr("data-cart-total-price", newTotal);
            });
        }
    });

    $('.stars button').on('click', function (e) {
        e.preventDefault();
        var selectedStar = $(this);
        var index = selectedStar.attr("data-index");
        document.getElementById("ratingInput").value = index;
        selectedStar.parent().find('button').each(function () {
            var star = $(this);
            if (star.attr("data-index") <= index) {
                star.addClass("text-secondary");
            } else {
                star.removeClass("text-secondary");
            }
        });
    });
    function formatCurrency(value) {

        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'decimal',
            minimumFractionDigits: 0,
        });

        let formatted = formatter.format(value);
        formatted = formatted.replace(/\./g, ',');
        return formatted;
    }

    //Hiển thị màu khi ấn vào trang chủ hoặc sản phẩm
    const navElement = $("#navbarCollapse");
    const currentUrl = window.location.pathname;
    navElement.find('a.nav-link').each(function () {
        const link = $(this);
        const href = link.attr('href');

        if (href === currentUrl) {
            link.addClass('active');
        } else {
            link.removeClass('active');
        }
    });


    if (params.has('factory')) {
        const factories = params.get('factory').split(',');
        factories.forEach(factory => {
            $(`#factoryFilter .form-check-input[value="${factory}"]`).prop('checked', true);
        });
    }


    if (params.has('target')) {
        const targets = params.get('target').split(',');
        targets.forEach(target => {
            $(`#targetFilter .form-check-input[value="${target}"]`).prop('checked', true);
        });
    }


    if (params.has('price')) {
        const prices = params.get('price').split(',');
        prices.forEach(price => {
            $(`#priceFilter .form-check-input[value="${price}"]`).prop('checked', true);
        });
    }


    if (params.has('sort')) {
        const sort = params.get('sort');
        $(`input[type="radio"][name="radio-sort"][value="${sort}"]`).prop('checked', true);
    }


    $('#search-icon-1 button').on('click', function () {
        $('#search-icon-1 button').on('click', function () {
            var inputValue = $('#search-input').val();  // Lấy giá trị từ ô tìm kiếm dựa trên ID
            if (inputValue) { // Kiểm tra xem người dùng đã nhập gì chưa
                var newUrl = '/search?name=' + encodeURIComponent(inputValue); // Mã hóa và tạo đường dẫn
                window.location.href = newUrl; // Chuyển hướng đến đường dẫn mới
            } else {
                alert("Vui lòng nhập từ khóa tìm kiếm.");
            }
        });
    });


})(jQuery);

