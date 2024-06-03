
$(window).on("load", function() {

    "use strict";

    window.onscroll = function() {fixedHeader()};
    var header = document.getElementById("header");
    var sticky = header.offsetTop;

    function fixedHeader() {
        if (window.pageYOffset > sticky) {
            header.classList.add("fixed-top");
        } else {
            header.classList.remove("fixed-top");
        }
    }




    var swiper = new Swiper(".latestProducts",  {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".tab-latest-next",
            prevEl: ".tab-latest-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".mostSales", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".tab-most-next",
            prevEl: ".tab-most-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".editorChoice", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".tab-editor-next",
            prevEl: ".tab-editor-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".makeupMostSales", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".categories", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".cat-next",
            prevEl: ".cat-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".care", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".care-next",
            prevEl: ".care-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".latest", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".latest-next",
            prevEl: ".latest-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".salon", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".salon-next",
            prevEl: ".salon-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });

    var swiper = new Swiper(".p-thumb", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".p-full-image", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".p-next",
            prevEl: ".p-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });

    //avatar
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });


    flatpickr(".flatpickr", {
        dateFormat: "Y-m-d",
    });

    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        showSelectedDialCode: true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
                .then(function(res) { return res.json(); })
                .then(function(data) { callback(data.country_code); })
                .catch(function() { callback(); });
        },
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@20.2.0/build/js/utils.js",
    });

});

$( document ).ready(function() {
    $(".tocart .button-title").text($(".tocart").data("title"));

    let itemCount = 0;

    $( ".tocart" ).on( "click", function() {
        var hello = $(this);
        itemCount ++;
        $('.s-cart-summary-count').html(itemCount);
        $( hello ).addClass("button--wait");
        $( hello ).find(".button-title").text("Adding...");
        $( hello ).find(".button-icon.icon-tocart").hide();
        $( hello ).find(".button-icon.icon-wait").show();
        $.jGrowl("Item added to cart successfully!", { theme: 'green' });

        setTimeout(function() {
            $( hello ).removeClass("button--wait").addClass("button--success");
            $( hello ).find(".button-title").text("Added!");
            $( hello ).find(".button-icon.icon-wait").hide();
            $( hello ).find(".button-icon.icon-success").show();
            setTimeout(function() {
                $( hello ).removeClass("button--wait").removeClass("button--success");
                $( hello ).find(".button-title").text($(".tocart").data("title"));
                $( hello ).find(".button-icon.icon-success").hide();
                $( hello ).find(".button-icon.icon-tocart").show();
            }, 2000);
        }, 2000);


    });


});

$(document).on("click", ".icon-fav", function() {
    const favIcon = $(this);
    const isAvailable = false; // Assuming logic to check availability is elsewhere

    if (isAvailable) {
        favIcon.addClass("added");
        $.jGrowl("Item added to wishlist successfully", { theme: 'green' });
    } else {
        $.jGrowl("To use this feature, you must be logged in", { theme: 'red' });
    }
});

$(document).on("click", ".added", function() {
    const favIcon = $(this);
    favIcon.removeClass("added");
    $.jGrowl("Item removed from wishlist", { theme: 'green' });
});

const inputs = document.querySelectorAll(".otp-field input");

inputs.forEach((input, index) => {
    input.dataset.index = index;
    input.addEventListener("keyup", handleOtp);
    input.addEventListener("paste", handleOnPasteOtp);
});

function handleOtp(e) {
    /**
     * <input type="text" 👉 maxlength="1" />
     * 👉 NOTE: On mobile devices `maxlength` property isn't supported,
     * So we to write our own logic to make it work. 🙂
     */
    const input = e.target;
    let value = input.value;
    let isValidInput = value.match(/[0-9a-z]/gi);
    input.value = "";
    input.value = isValidInput ? value[0] : "";

    let fieldIndex = input.dataset.index;
    if (fieldIndex < inputs.length - 1 && isValidInput) {
        input.nextElementSibling.focus();
    }

    if (e.key === "Backspace" && fieldIndex > 0) {
        input.previousElementSibling.focus();
    }

    if (fieldIndex == inputs.length - 1 && isValidInput) {
        submit();
    }
}

function handleOnPasteOtp(e) {
    const data = e.clipboardData.getData("text");
    const value = data.split("");
    if (value.length === inputs.length) {
        inputs.forEach((input, index) => (input.value = value[index]));
        submit();
    }
}

function submit() {
    console.log("Submitting...");
    $('#enterOtp').modal('hide');
    // 👇 Entered OTP
    let otp = "";
    inputs.forEach((input) => {
        otp += input.value;
        input.disabled = true;
        input.classList.add("disabled");
    });
    console.log(otp);
    // 👉 Call API below
}


$(document).ready(function () {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function () {
        $(this)
            .find(".fa-solid")
            .addClass("fa-minus")
            .removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse")
        .on("show.bs.collapse", function () {
            $(this)
                .find(".fa-solid")
                .removeClass("fa-plus")
                .addClass("fa-minus");
        })
});

$(document).ready(function(){
    $(".item").slice(0,9).show();
    $("#load-more").click(function(e){
        e.preventDefault();
        $(".item:hidden").slice(0,9).fadeIn("slow");
        // or make ajax call and append

        if($(".item:hidden").length == 0){
            $("#load-more").fadeOut("slow");
        }
    });


})

$(document).ready(function() {
    // Prepend back button to sub menu(s)
    $('.nav__sub').prepend('<li class="nav__item"><a class="nav__link sub__close" href="#"><i class="fas fa-chevron-left"></i> Back</a></li>');

    // Close out sub menu
    $(document).on('click', '.sub__close', function(e) {
        e.preventDefault();
        $(this).closest('.nav__sub').removeClass('is-active');
    });

    // Trigger sub menu
    $(document).on('click', '.nav__link', function(e) {
        var $submenu = $(this).siblings('.nav__sub');
        if ($submenu.length > 0) {
            e.preventDefault(); // Prevent default only if submenu exists
            $submenu.addClass('is-active');
        }
    });
});



// Smooth scrolling to section
document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
