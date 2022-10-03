var modal = `
<div class="modal fade" id="submitReq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-md-5">
                <h2 class="h4 text-center">Brisanje</h2>
                <p class="text-center mb-4">Da li ste sigurni?</p>
                <div class="d-grid">
                    <button onclick="$('form#multiDeleteForm').submit();" type="button" class="btn btn-danger">Obriši</button>
                </div>
            </div>
        </div>
    </div>
</div>
`;

document.getElementsByTagName("body")[0].innerHTML += modal;

let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

if (!isMobile) {
    $(window).resize(function () {
        if ($(window).width() < 1048) {
            if ($(".mobile-wrapper").is(":visible")) {
                $(".mobile-wrapper").hide();
            }
        } else {
            $(".mobile-wrapper").show();
        }
    });
}

if ($(window).width() < 1048) {
    $(".mobile-wrapper").hide();
} else {
    $(".mobile-wrapper").show();
}

$(".nav-icon-btn").on("click", function () {
    $(".mobile-wrapper").fadeIn();
});

$("#mobile-close-search-button").on("click", function () {
    $(".mobile-wrapper").fadeOut();
});

let knjige = $("#searchBookList");
let studenti = $("#searchStudentList");
let bibliotekari = $("#searchLibrarianList");
let autori = $("#searchAuthorList");
let form = $("#searchForm");

function search() {
    if ($("#SearchBar").val().length >= 3) {
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "/searchstaff",
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: form.serialize(),
                success: function (data) {
                    setTimeout(function () {
                        knjige.empty();
                        studenti.empty();
                        bibliotekari.empty();
                        autori.empty();
                        if ($("#SearchBar").val().length >= 3) {
                            $("#searchBoxResults").fadeIn();
                            $.each(data.books, function (k, book) {
                                knjige
                                    .append(
                                        `
                                                <a href="/books/${book.id}">
                                                    <li class="list-group-item mb-2" style="border:0">
                                                        <span class="name mb-0 text-purple">${book.title}</span>
                                                    </li>
                                                </a>
                                `
                                    )
                                    .show("slow");
                            });
                            $.each(data.students, function (k, student) {
                                studenti
                                    .append(
                                        `
                                                <a href="/students/${student.id}">
                                                    <li class="list-group-item mb-2" style="border:0">
                                                        <span class="name mb-0 text-purple">${student.name}</span>
                                                    </li>
                                                </a>
                                `
                                    )
                                    .show("slow");
                            });
                            $.each(data.librarians, function (k, librarian) {
                                bibliotekari
                                    .append(
                                        `
                                                <a href="/librarians/${librarian.id}">
                                                    <li class="list-group-item mb-2" style="border:0">
                                                        <span class="name mb-0 text-purple">${librarian.name}</span>
                                                    </li>
                                                </a>
                                `
                                    )
                                    .show("slow");
                            });
                            $.each(data.authors, function (k, author) {
                                autori
                                    .append(
                                        `
                                                <a href="/authors/${author.id}">
                                                    <li class="list-group-item mb-2" style="border:0">
                                                        <span class="name mb-0 text-purple">${author.full_name}</span>
                                                    </li>
                                                </a>
                                `
                                    )
                                    .show("slow");
                            });
                        } else {
                            $("#searchBoxResults").fadeOut();
                        }
                    }, 300);
                },
            });
        }, 300);
    }
}

if (!isMobile) {
    $(document).click(function () {
        $("#searchBoxResults").hide();
    });
}

$("input#bookFilter").change(function () {
    if (!this.checked) {
        $("#bookList").hide();
    } else {
        $("#bookList").show();
    }
});

$("input#studentFilter").change(function () {
    if (!this.checked) {
        $("#studentList").hide();
    } else {
        $("#studentList").show();
    }
});

$("input#librarianFilter").change(function () {
    if (!this.checked) {
        $("#librarianList").hide();
    } else {
        $("#librarianList").show();
    }
});

$("input#authorFilter").change(function () {
    if (!this.checked) {
        $("#authorList").hide();
    } else {
        $("#authorList").show();
    }
});

$(window).on("load", function () {
    $("#layout").fadeOut();
});

$(document).ready(function () {
    $("#search")
        .focus(function () {
            if ($(window).width() < 991) {
                $("#userinfo").hide();
                $("#search").addClass("d-flex justify-content-center");
            }
        })
        .focusout(function () {
            $("#userinfo").show();
            $("#search").removeClass("d-flex justify-content-center");
        });
});

$("input#checkbox").click(function () {
    var checkbox = $("#myTable tbody").find(":checkbox").length;
    var checked = $("#myTable tbody").find(":checked").length;
    if (checkbox === checked) {
        document.getElementById("checkAll").checked = true;
    } else {
        document.getElementById("checkAll").checked = false;
    }
    if ($(this).is(":checked")) {
        $("#submitbtn").removeAttr("disabled");
    } else {
        if (checked === 0) {
            $("#submitbtn").attr("disabled", true);
        }
    }
});

$("#checkAll").click(function () {
    $("input#checkbox").prop("checked", this.checked);
    if ($(this).is(":checked")) {
        $("#submitbtn").removeAttr("disabled");
    } else {
        $("#submitbtn").attr("disabled", true);
    }
});

var table = $("#myTable").DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    bProcessing: true,
    dom:
        "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>",
    language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/sr-SP.json",
    },
    buttons: [
        {
            text: "Obriši",
            attr: {
                id: "submitbtn",
                disabled: true,
            },
            className: "btn btn-primary",
            action: function (e, dt, node, config) {
                // $('form#multiDeleteForm').submit();
                $("#submitReq").modal("toggle");
            },
        },
    ],
});

$("#myTable thead tr").clone(true).appendTo("#myTable thead");
$("#myTable thead tr:eq(1) th")
    .attr("colspan", "1")
    .attr("rowspan", "1")
    .slice(1)
    .each(function (i) {
        i += 1;

        var title = $(this).text();
        if (title != "Akcija") {
            $(this).html(
                '<input type="text" class="form-control" style="width: 100%" placeholder="Pretraži ' +
                    title +
                    '" />'
            );

            $("input", this).on("keyup change", function () {
                if (table.column(i).search() !== this.value) {
                    table.column(i).search(this.value).draw();
                }
            });
        } else $(this).text("");
    });

$(document.querySelectorAll(".checkbox")[1]).css("display", "none");

function funkcijaDatumVracanja(policyValue) {
    var selectedDate = new Date($("#datumIzdavanja").val());
    var numberOfDaysToAdd = policyValue;

    selectedDate.setDate(selectedDate.getDate() + numberOfDaysToAdd);

    var day = selectedDate.getDate();
    var month = selectedDate.getMonth() + 1;
    var year = selectedDate.getFullYear();

    var newDate = [day, month, year].join("/");

    document.getElementById("datumVracanja").value = newDate;
}

// DOM utility functions:
const el = (sel, par) => (par || document).querySelector(sel);
const els = (sel, par) => (par || document).querySelectorAll(sel);

// Task: modal:
const toggleModal = (evt) => {
    const sel = evt.currentTarget.dataset.modal;
    if (!sel) evt.currentTarget.closest(".Modal").classList.remove("is-open");
    el(sel).classList.add("is-open");
};

els("[data-modal]").forEach((elModalButton) => {
    elModalButton.addEventListener("click", toggleModal);
});

addEventListener("click", (evt) => {
    // if click on button or inside modal — do nothing
    if (evt.target.closest("[data-modal]") || evt.target.closest(".Modal"))
        return;
    // else — close any open modal:
    els(".Modal.is-open").forEach((elModalOpen) => {
        elModalOpen.classList.remove("is-open");
    });
});

var cropperFunction = function (e) {
    var cropperOverlay = document.getElementById("cropper-wrapper");
    var cropperPreview = document.getElementById("cropper-preview");
    var croppedOutput = document.getElementById("image-output");
    var cropperCropBtn = document.getElementById("cropper-crop-btn");
    var cropperCancleBtn = document.getElementById("cropper-cancle-btn");
    var form = document.getElementById("myForm");

    var cropper;

    // load cropper overlay and crop image
    if (e.target.files && e.target.files[0]) {
        console.log(e.target.files[0].type);
        if (
            e.target.files[0].type === "image/jpeg" ||
            e.target.files[0].type === "image/png" ||
            e.target.files[0].type === "image/jpg" ||
            e.target.files[0].type === "image/gif"
        ) {
            // file reader API
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = function (e) {
                // setup cropper
                cropperPreview.src = e.target.result;
                var options = { aspectRatio: 1 };
                cropperOverlay.style.display = "block";
                cropper = new Cropper(cropperPreview, options);
            };
        }

        // save cropped data
        cropperCropBtn.addEventListener("click", function (e) {
            // get cropped data from cropper && display cropped image into output block
            cropper.getCroppedCanvas().toBlob((blob) => {
                $('input[type="file"]').val("");
                var file = new File([blob], Date.now(), { type: blob.type });
                var container = new DataTransfer();

                container.items.add(file);

                var input = document.createElement("input");
                input.name = "picture";
                input.type = "file";
                input.files = container.files;
                input.classList.add("visually-hidden");
                form.appendChild(input);

                croppedOutput.style.display = "block";
                croppedOutput.src = URL.createObjectURL(blob);
                var imageStudent = document.getElementById("image-output");
                var addPhotoText = document.getElementById("addphototext");
                imageStudent.style.display = "block";
                addPhotoText.style.display = "none";
                imageStudent.src = URL.createObjectURL(blob);
            });

            // destroy cropper and cropper overlay
            cropper.destroy();
            cropper = null;
            cropperOverlay.style.display = "none";
            var placeholder = document.getElementById("addphototext");
            croppedOutput.removeAttribute("hidden");

            placeholder.style.display = "none";
            $('input[type="file"]').val("");
        });

        // reject cropped data
        cropperCancleBtn.addEventListener("click", function (e) {
            cropper.destroy();
            cropper = null;
            cropperOverlay.style.display = "none";
            $('input[type="file"]').val("");
        });
    }
};

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#password_confirm").val();

    if (password.length > 8 || confirmPassword.length >= 8) {
        if (password != confirmPassword) {
            $(".invalid-feedback").html(" Lozinke se ne poklapaju!");
            $(".invalid-feedback").addClass("d-flex");
            $("#submitDugme").prop("disabled", true);
            return false;
        } else {
            $(".invalid-feedback").removeClass("d-flex");
            $("#submitDugme").prop("disabled", false);
            return true;
        }
    } else {
        $(".invalid-feedback").html(
            "Lozinka treba da sadrži više od 8 karaktera!"
        );
        $(".invalid-feedback").addClass("d-flex");
    }
}

("use strict");
const d = document;
d.addEventListener("DOMContentLoaded", function (event) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary me-3",
            cancelButton: "btn btn-gray",
        },
        buttonsStyling: false,
    });

    // options
    const breakpoints = {
        sm: 540,
        md: 720,
        lg: 960,
        xl: 1140,
    };

    var preloader = d.querySelector(".preloader");
    if (preloader) {
        setTimeout(function () {
            preloader.classList.add("show");

            setTimeout(function () {
                d.querySelector(".loader-element").classList.add("hide");
            }, 200);
        }, 1000);
    }

    var sidebar = document.getElementById("sidebarMenu");
    var content = document.getElementsByClassName("content")[0];
    if (sidebar && d.body.clientWidth < breakpoints.lg) {
        sidebar.addEventListener("shown.bs.collapse", function () {
            document.querySelector("body").style.position = "relative";
            sidebar.classList.remove("contracted");
            localStorage.removeItem("sidebar", "contracted");
            $("#separator").removeClass("w-45");
        });
        sidebar.addEventListener("hidden.bs.collapse", function () {
            document.querySelector("body").style.position = "relative";
            sidebar.classList.add("contracted");
            localStorage.setItem("sidebar", "contracted");
            $("#separator").addClass("w-45");
        });
    }

    var iconNotifications = d.querySelector(".notification-bell");
    if (iconNotifications) {
        iconNotifications.addEventListener("shown.bs.dropdown", function () {
            iconNotifications.classList.remove("unread");
        });
    }

    [].slice.call(d.querySelectorAll("[data-background]")).map(function (el) {
        el.style.background = "url(" + el.getAttribute("data-background") + ")";
    });

    [].slice
        .call(d.querySelectorAll("[data-background-lg]"))
        .map(function (el) {
            if (document.body.clientWidth > breakpoints.lg) {
                el.style.background =
                    "url(" + el.getAttribute("data-background-lg") + ")";
            }
        });

    [].slice
        .call(d.querySelectorAll("[data-background-color]"))
        .map(function (el) {
            el.style.background =
                "url(" + el.getAttribute("data-background-color") + ")";
        });

    [].slice.call(d.querySelectorAll("[data-color]")).map(function (el) {
        el.style.color = "url(" + el.getAttribute("data-color") + ")";
    });

    //Tooltips
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Popovers
    var popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Datepicker
    var datepickers = [].slice.call(d.querySelectorAll("[data-datepicker]"));
    var datepickersList = datepickers.map(function (el) {
        return new Datepicker(el, {
            buttonClass: "btn",
        });
    });

    // DataTables
    var dataTableEl = d.getElementById("datatable");
    if (dataTableEl) {
        const dataTable = new simpleDatatables.DataTable(dataTableEl);
    }

    if (d.querySelector(".input-slider-container")) {
        [].slice
            .call(d.querySelectorAll(".input-slider-container"))
            .map(function (el) {
                var slider = el.querySelector(":scope .input-slider");
                var sliderId = slider.getAttribute("id");
                var minValue = slider.getAttribute("data-range-value-min");
                var maxValue = slider.getAttribute("data-range-value-max");

                var sliderValue = el.querySelector(
                    ":scope .range-slider-value"
                );
                var sliderValueId = sliderValue.getAttribute("id");
                var startValue = sliderValue.getAttribute(
                    "data-range-value-low"
                );

                var c = d.getElementById(sliderId),
                    id = d.getElementById(sliderValueId);

                noUiSlider.create(c, {
                    start: [parseInt(startValue)],
                    connect: [true, false],
                    //step: 1000,
                    range: {
                        min: [parseInt(minValue)],
                        max: [parseInt(maxValue)],
                    },
                });
            });
    }

    if (d.getElementById("input-slider-range")) {
        var c = d.getElementById("input-slider-range"),
            low = d.getElementById("input-slider-range-value-low"),
            e = d.getElementById("input-slider-range-value-high"),
            f = [d, e];

        noUiSlider.create(c, {
            start: [
                parseInt(low.getAttribute("data-range-value-low")),
                parseInt(e.getAttribute("data-range-value-high")),
            ],
            connect: !0,
            tooltips: true,
            range: {
                min: parseInt(c.getAttribute("data-range-value-min")),
                max: parseInt(c.getAttribute("data-range-value-max")),
            },
        }),
            c.noUiSlider.on("update", function (a, b) {
                f[b].textContent = a[b];
            });
    }

    // Weekly Sales Chart
    var optionsWeeklySalesChart = {
        series: [
            {
                name: "Sales",
                data: [32, 44, 37, 47, 42, 55, 47, 65],
            },
        ],
        chart: {
            type: "bar",
            width: "100%",
            height: 260,
            sparkline: {
                enabled: true,
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                color: "#31316A",
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "20%",
                borderRadius: 5,
                radiusOnLastStackedBar: true,
                horizontal: false,
                distributed: false,
                endindShape: "rounded",
                colors: {
                    backgroundBarColors: [
                        "#F2F4F6",
                        "#F2F4F6",
                        "#F2F4F6",
                        "#F2F4F6",
                    ],
                    backgroundBarRadius: 5,
                },
            },
        },
        labels: [1, 2, 3, 4, 5, 6, 7, 8],
        xaxis: {
            categories: [
                "Week 1",
                "Week 2",
                "Week 3",
                "Week 4",
                "Week 5",
                "Week 6",
                "Week 7",
                "Week 8",
            ],
            crosshairs: {
                width: 1,
            },
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
            },
            y: {
                formatter: function (val) {
                    return "$ " + val + "k";
                },
            },
        },
    };

    var weeklySalesChartEl = document.getElementById("chart-weekly-sales");
    if (weeklySalesChartEl) {
        var weeklySalesChart = new ApexCharts(
            weeklySalesChartEl,
            optionsWeeklySalesChart
        );
        weeklySalesChart.render();
    }

    //Customers Chart
    var optionsCustomersChart = {
        series: [
            {
                name: "Clients",
                data: [120, 160, 200, 470, 420, 150, 470, 750, 650, 190, 140],
            },
        ],
        labels: [
            "01 Feb",
            "02 Feb",
            "03 Feb",
            "04 Feb",
            "05 Feb",
            "06 Feb",
            "07 Feb",
            "08 Feb",
            "09 Feb",
            "10 Feb",
            "11 Feb",
        ],
        chart: {
            type: "area",
            width: "100%",
            height: 140,
            sparkline: {
                enabled: true,
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                color: "#31316A",
            },
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
            },
        },
    };

    var customersChartEl = document.getElementById("chart-customers");
    if (customersChartEl) {
        var customersChart = new ApexCharts(
            customersChartEl,
            optionsCustomersChart
        );
        customersChart.render();
    }

    //Today Users Chart
    var optionsUsersChart = {
        series: [
            {
                name: "Users",
                data: [520, 560, 500, 570, 520, 550, 570, 550, 550, 590, 540],
            },
        ],
        labels: [
            "06PM",
            "02 Feb",
            "03 Feb",
            "04 Feb",
            "05 Feb",
            "06 Feb",
            "07 Feb",
            "08 Feb",
            "09 Feb",
            "10 Feb",
            "11 Feb",
        ],
        chart: {
            type: "area",
            width: "100%",
            height: 140,
            sparkline: {
                enabled: true,
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                color: "#31316A",
            },
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
            },
        },
    };

    var usersChartEl = document.getElementById("chart-users");
    if (usersChartEl) {
        var usersChart = new ApexCharts(usersChartEl, optionsUsersChart);
        usersChart.render();
    }

    // Revenue Chart
    var optionsRevenueChart = {
        series: [
            {
                name: "Sales",
                data: [34, 29, 32, 38, 39, 35, 36],
            },
        ],
        chart: {
            type: "bar",
            width: "100%",
            height: 140,
            sparkline: {
                enabled: true,
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                color: "#31316A",
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "25%",
                borderRadius: 5,
                radiusOnLastStackedBar: true,
                colors: {
                    backgroundBarColors: [
                        "#F2F4F6",
                        "#F2F4F6",
                        "#F2F4F6",
                        "#F2F4F6",
                    ],
                    backgroundBarRadius: 5,
                },
            },
        },
        labels: [1, 2, 3, 4, 5, 6, 7],
        xaxis: {
            categories: [
                "01 Feb",
                "02 Feb",
                "03 Feb",
                "04 Feb",
                "05 Feb",
                "06 Feb",
                "07 Feb",
            ],
            crosshairs: {
                width: 1,
            },
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
            },
            y: {
                formatter: function (val) {
                    return "$ " + val + "k";
                },
            },
        },
    };

    var revenueChartEl = document.getElementById("chart-revenue");
    if (revenueChartEl) {
        var revenueChart = new ApexCharts(revenueChartEl, optionsRevenueChart);
        revenueChart.render();
    }

    //Traffic volumes
    var optionsTrafficVolumesChart = {
        series: [
            {
                name: "Direct",
                data: [7100, 9600, 10000, 8700, 12000, 15400, 19000],
            },
            {
                name: "Refferals",
                data: [4100, 6800, 7000, 6700, 7200, 14000, 12000],
            },
            {
                name: "Organic",
                data: [1100, 3200, 4500, 3200, 3400, 5200, 4100],
            },
        ],
        colors: ["#4D4AE8", "#FD8E7A", "#06A77D", "#51449E"],
        chart: {
            height: 420,
            type: "line",
            fontFamily: "Inter",
            foreColor: "#4B5563",
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: false,
                    selection: false,
                    zoom: false,
                    zoomin: true,
                    zoomout: true,
                    pan: false,
                    reset:
                        false |
                        '<img src="/static/icons/reset.png" width="20">',
                    customIcons: [],
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ",",
                        headerCategory: "category",
                        headerValue: "value",
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString();
                        },
                    },
                },
                autoSelected: "zoom",
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        grid: {
            show: true,
            borderColor: "#f2f2f2",
            strokeDashArray: 1,
        },
        xaxis: {
            categories: [
                "01 Feb",
                "02 Feb",
                "03 Feb",
                "04 Feb",
                "05 Feb",
                "06 Feb",
                "07 Feb",
            ],
            labels: {
                style: {
                    fontSize: "12px",
                    fontWeight: 500,
                },
            },
            axisBorder: {
                color: "#ffffff",
            },
            axisTicks: {
                color: "#ffffff",
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: ["#4B5563"],
                    fontSize: "12px",
                    fontWeight: 500,
                },
            },
        },
        legend: {
            show: true,
            fontSize: "14px",
            fontFamily: "Inter",
            fontWeight: 400,
            height: 60,
            tooltipHoverFormatter: undefined,
            offsetY: 20,
            markers: {
                width: 14,
                height: 14,
                strokeWidth: 1,
                strokeColor: "#fff",
                radius: 50,
            },
        },
        responsive: [
            {
                breakpoint: 768,
                options: {
                    yaxis: {
                        show: false,
                    },
                },
            },
        ],
    };

    var trafficVolumesChartEl = document.getElementById(
        "traffic-volumes-chart"
    );
    if (trafficVolumesChartEl) {
        var trafficVolumesChart = new ApexCharts(
            trafficVolumesChartEl,
            optionsTrafficVolumesChart
        );
        trafficVolumesChart.render();
    }

    // Sales by Product
    var optionsTrafficShareChart = {
        series: [
            {
                name: "Visits",
                data: [4, 7, 9, 29, 51],
            },
        ],
        chart: {
            type: "bar",
            height: 500,
            foreColor: "#4B5563",
            fontFamily: "Inter",
        },
        plotOptions: {
            bar: {
                horizontal: true,
                distributed: false,
                barHeight: "90%",
                borderRadius: 10,
                colors: {
                    backgroundBarColors: ["#fff"],
                    backgroundBarOpacity: 0.2,
                    backgroundBarRadius: 10,
                },
            },
        },
        colors: ["#4D4AE8"],
        dataLabels: {
            enabled: true,
            textAnchor: "middle",
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex];
            },
            offsetY: -1,
            dropShadow: {
                enabled: false,
            },
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
                fontWeight: "500",
            },
        },
        grid: {
            show: false,
            borderColor: "#f2f2f2",
            strokeDashArray: 1,
        },
        legend: {
            show: false,
        },
        yaxis: {
            labels: {
                show: false,
            },
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter",
            },
            y: {
                formatter: function (val) {
                    return val + "%";
                },
            },
        },
        xaxis: {
            categories: ["Mail", "Social", "Organic", "Referrals", "Direct"],
            labels: {
                style: {
                    fontSize: "12px",
                    fontWeight: 500,
                },
                offsetY: 5,
            },
            axisBorder: {
                color: "#ffffff",
            },
            axisTicks: {
                color: "#ffffff",
                offsetY: 5,
            },
        },
    };

    var trafficShareChartEl = document.getElementById("traffic-share-chart");
    if (trafficShareChartEl) {
        var trafficShareChart = new ApexCharts(
            trafficShareChartEl,
            optionsTrafficShareChart
        );
        trafficShareChart.render();
    }

    // Total Orders Chart
    var optionsAppRankingChart = {
        series: [
            {
                name: "Travel & Local",
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
            },
            {
                name: "Widgets",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
            },
        ],
        chart: {
            type: "bar",
            height: "400px",
            fontFamily: "Inter",
            foreColor: "#4B5563",
        },
        colors: ["#f0bc74", "#31316A"],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "40%",
                borderRadius: 10,
                colors: {
                    backgroundBarColors: ["#fff"],
                    backgroundBarOpacity: 0.2,
                    backgroundBarRadius: 10,
                },
            },
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: true,
            fontSize: "14px",
            fontFamily: "Inter",
            fontWeight: 500,
            height: 40,
            tooltipHoverFormatter: undefined,
            offsetY: 10,
            markers: {
                width: 14,
                height: 14,
                strokeWidth: 1,
                strokeColor: "#ffffff",
                radius: 50,
            },
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
            ],
            labels: {
                style: {
                    fontSize: "12px",
                    fontWeight: 500,
                },
            },
            axisBorder: {
                color: "#EBE3EE",
            },
            axisTicks: {
                color: "#f1f1f1",
            },
        },
        yaxis: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
        responsive: [
            {
                breakpoint: 1499,
                options: {
                    chart: {
                        height: "400px",
                    },
                },
            },
        ],
    };

    var appRankingChartEl = document.getElementById("chart-app-ranking");
    if (appRankingChartEl) {
        var appRankingChart = new ApexCharts(
            appRankingChartEl,
            optionsAppRankingChart
        );
        appRankingChart.render();
    }

    if (d.getElementById("loadOnClick")) {
        d.getElementById("loadOnClick").addEventListener("click", function () {
            var button = this;
            var loadContent = d.getElementById("extraContent");
            var allLoaded = d.getElementById("allLoadedText");

            button.classList.add("btn-loading");
            button.setAttribute("disabled", "true");

            setTimeout(function () {
                loadContent.style.display = "block";
                button.style.display = "none";
                allLoaded.style.display = "block";
            }, 1500);
        });
    }

    var scroll = new SmoothScroll('a[href*="#"]', {
        speed: 500,
        speedAsDuration: true,
    });

    // SVG Map
    if (d.querySelector("#map")) {
        new svgMap({
            targetElementID: "map",
            colorMin: "#FCE1C3",
            colorMax: "#F8BD7A",
            flagType: "emoji",
            data: {
                data: {
                    visitors: {
                        name: "Visitors",
                        format: "{0} visitors",
                        thousandSeparator: ",",
                        thresholdMax: 500000,
                        thresholdMin: 0,
                    },
                    change: {
                        name: "Change by month",
                        format: "{0} %",
                    },
                },
                applyData: "visitors",
                values: {
                    US: { visitors: 272109, change: 4.73 },
                    CA: { visitors: 160064, change: 11.09 },
                    DE: { visitors: 120048, change: -2.3 },
                    GB: { visitors: 110048, change: 3.3 },
                    FR: { visitors: 100048, change: 1.3 },
                    ES: { visitors: 90048, change: 1.5 },
                    JP: { visitors: 56022, change: 3.5 },
                    IT: { visitors: 48019, change: 1 },
                    NL: { visitors: 40016, change: 2 },
                    RU: { visitors: 30016, change: 3.4 },
                    CN: { visitors: 50016, change: 6 },
                    IN: { visitors: 140016, change: 2 },
                    BR: { visitors: 40016, change: 5 },
                    // ...
                },
            },
        });
    }

    // Dropzone
    if (d.querySelector("myDropzone")) {
        // Dropzone class:
        var myDropzone = new Dropzone("div#myId", { url: "/file/post" });
    }

    // Full Calendar
    var calendarEl = d.getElementById("calendar");
    if (calendarEl) {
        var events = [
            {
                id: 1,
                title: "Call with Jane",
                start: "2020-11-18",
                end: "2020-11-19",
                className: "bg-red",
            },

            {
                id: 2,
                title: "Dinner meeting",
                start: "2020-11-21",
                end: "2020-11-22",
                className: "bg-orange",
            },

            {
                id: 3,
                title: "HackTM conference",
                start: "2020-11-29",
                end: "2020-11-30",
                className: "bg-green",
            },

            {
                id: 4,
                title: "Meeting with John",
                start: "2020-12-01",
                end: "2020-12-02",
                className: "bg-blue",
            },

            {
                id: 5,
                title: "Summer Hackaton",
                start: "2020-12-03",
                end: "2020-12-04",
                className: "bg-purple",
            },

            {
                id: 6,
                title: "Digital event",
                start: "2020-12-07",
                end: "2020-12-09",
                className: "bg-info",
            },

            {
                id: 7,
                title: "Marketing event",
                start: "2020-12-10",
                end: "2020-12-11",
                className: "bg-blue",
            },

            {
                id: 8,
                title: "Dinner with Parents",
                start: "2020-12-19",
                end: "2020-12-20",
                className: "bg-red",
            },

            {
                id: 9,
                title: "Black Friday",
                start: "2020-12-23",
                end: "2020-12-24",
                className: "bg-yellow",
            },

            {
                id: 10,
                title: "Cyber Week",
                start: "2020-12-02",
                end: "2020-12-03",
                className: "bg-red",
            },
        ];

        var addNewEventModalEl = d.getElementById("modal-new-event");
        var addNewEventModal = new bootstrap.Modal(addNewEventModalEl);
        var newEventTitleInput = d.getElementById("eventTitle");
        var newEventStartDatepicker = new Datepicker(
            d.getElementById("dateStart"),
            { buttonClass: "btn" }
        );
        var newEventEndDatepicker = new Datepicker(
            d.getElementById("dateEnd"),
            { buttonClass: "btn" }
        );

        var editEventModalEl = d.getElementById("modal-edit-event");
        var editEventModal = new bootstrap.Modal(editEventModalEl);
        var editEventTitleInput = d.getElementById("eventTitleEdit");
        var editEventStartDatepicker = new Datepicker(
            d.getElementById("dateStartEdit"),
            { buttonClass: "btn" }
        );
        var editEventEndDatepicker = new Datepicker(
            d.getElementById("dateEndEdit"),
            { buttonClass: "btn" }
        );

        // current id selection
        var currentId = null;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            initialView: "dayGridMonth",
            themeSystem: "bootstrap",
            initialDate: "2020-12-01",
            editable: true,
            events: events,
            buttonText: {
                prev: "Previous",
                next: "Next",
            },
            dateClick: function (d) {
                addNewEventModal.show();
                newEventTitleInput.value = "";
                newEventStartDatepicker.setDate(d.date);
                newEventEndDatepicker.setDate(
                    d.date.setDate(d.date.getDate() + 1)
                );

                addNewEventModalEl.addEventListener(
                    "shown.bs.modal",
                    function () {
                        newEventTitleInput.focus();
                    }
                );
            },
            eventClick: function (info, element) {
                // set current id
                currentId = info.event.id;
                editEventTitleInput.value = info.event.title;
                editEventStartDatepicker.setDate(info.event.start);
                editEventEndDatepicker.setDate(
                    info.event.end ? info.event.end : info.event.start
                );

                editEventModal.show();
                editEventModalEl.addEventListener(
                    "shown.bs.modal",
                    function () {
                        editEventTitleInput.focus();
                    }
                );
            },
        });
        calendar.render();
        console.log(calendar);

        d.getElementById("addNewEventForm").addEventListener(
            "submit",
            function (event) {
                event.preventDefault();
                calendar.addEvent({
                    id: Math.random() * 10000, // this should be a unique id from your back-end or API
                    title: newEventTitleInput.value,
                    start: moment(newEventStartDatepicker.getDate()).format(
                        "YYYY-MM-DD"
                    ),
                    end: moment(newEventEndDatepicker.getDate()).format(
                        "YYYY-MM-DD"
                    ),
                    className: "bg-secondary",
                    dragabble: true,
                });
                addNewEventModal.hide();
            }
        );

        d.getElementById("editEventForm").addEventListener(
            "submit",
            function (event) {
                event.preventDefault();
                var editEvent = calendar.getEventById(currentId);
                var startDate = moment(
                    editEventStartDatepicker.getDate()
                ).format("YYYY-MM-DD");
                var endDate = moment(editEventEndDatepicker.getDate()).format(
                    "YYYY-MM-DD"
                );

                editEvent.setProp("title", editEventTitleInput.value);
                editEvent.setStart(startDate);
                editEvent.setEnd(endDate);
                editEventModal.hide();
            }
        );

        d.getElementById("deleteEvent").addEventListener("click", function () {
            swalWithBootstrapButtons
                .fire({
                    icon: "error",
                    title: "Confirm deletion",
                    text: "Are you sure you want to delete this event?",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                })
                .then(function (result) {
                    if (result.value) {
                        swalWithBootstrapButtons.fire(
                            "Deleted!",
                            "The event has been deleted.",
                            "success"
                        );
                        calendar.getEventById(currentId).remove();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        editEventModal.hide();
                    }
                });
        });
    }

    if (d.querySelector(".current-year")) {
        d.querySelector(".current-year").textContent = new Date().getFullYear();
    }

    // Glide JS

    if (d.querySelector(".glide")) {
        new Glide(".glide", {
            type: "carousel",
            startAt: 0,
            perView: 3,
        }).mount();
    }

    if (d.querySelector(".glide-testimonials")) {
        new Glide(".glide-testimonials", {
            type: "carousel",
            startAt: 0,
            perView: 1,
            autoplay: 2000,
        }).mount();
    }

    if (d.querySelector(".glide-clients")) {
        new Glide(".glide-clients", {
            type: "carousel",
            startAt: 0,
            perView: 5,
            autoplay: 2000,
        }).mount();
    }

    if (d.querySelector(".glide-news-widget")) {
        new Glide(".glide-news-widget", {
            type: "carousel",
            startAt: 0,
            perView: 1,
            autoplay: 2000,
        }).mount();
    }

    if (d.querySelector(".glide-autoplay")) {
        new Glide(".glide-autoplay", {
            type: "carousel",
            startAt: 0,
            perView: 3,
            autoplay: 2000,
        }).mount();
    }

    /*

    Check out the styles here: https://www.mapbox.com/maps/streets
    To change the style of the map change the mapboxId attribute with the following available styles:

    mapbox/dark-v10, mapbox/light-v10, mapbox/streets-v11, mapbox/outdoors/v-11, mapbox/satellite-streets-v11

    This is based on the URL you can when clicking on the preview link from Mapbox.

    You need to generate your own mapboxToken by creating an account. This token will NOT work for your website, you need to generate your own one!

    */

    var config = {
        mapboxToken:
            "pk.eyJ1Ijoiem9sdGFudGhlbWVzYmVyZyIsImEiOiJjazZqaWUwcWswYTBvM21td2Jmcm5mYmdyIn0.7_5YCbbOFRnvqZzCNDo9fw",
        mapboxId: "mapbox/light-v10",
    };

    var baseLatLng = [37.57, -122.26];
    var zoom = 10;
    var listings = [
        {
            url: "#",
            latLng: [37.7, -122.41],
            name: "Call with Jane",
            date: "Tomorrow at 12:30 PM",
        },
        {
            url: "#",
            latLng: [37.59, -122.39],
            name: "HackTM conference",
            date: "In about 5 minutes",
        },
        {
            url: "#",
            latLng: [37.52, -122.29],
            name: "Marketing event",
            date: "Today at 1:00 PM",
        },
        {
            url: "#",
            latLng: [37.37, -122.12],
            name: "Dinner with partners",
            date: "In 2 hours",
        },
        {
            url: "#",
            latLng: [37.36, -121.94],
            name: "Interview with Google",
            date: "In two days at 15:00 PM",
        },
    ];

    if (d.querySelector("#mapbox")) {
        var icon = L.icon({
            iconUrl: "../assets/img/marker.svg",
            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-3, -76], // point from which the popup should open relative to the iconAnchor
        });

        // modal listing view
        var mapListings = L.map("mapbox").setView(baseLatLng, zoom);
        L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
            {
                attribution:
                    'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: config.mapboxId,
                accessToken: config.mapboxToken,
            }
        ).addTo(mapListings);

        listings.map(function (listing, index) {
            var popupHtml = `
                <a href="${listing.url}" class="card card-article-wide border-0 flex-column no-gutters no-hover">
                    <div class="card-body py-0 d-flex flex-column justify-content-between col-12">
                        <h4 class="h5 fw-normal mb-2">${listing.name}</h4>
                        <div class="d-flex"><div class="icon icon-xs icon-tertiary me-2"><span class="fas fa-clock"></span></div><div class="font-xs text-dark">${listing.date}</div></div>
                    </div>
                </a>
            `;

            var marker = L.marker(listing.latLng, { icon: icon }).addTo(
                mapListings
            );
            marker.bindPopup(popupHtml);
        });
    }

    // Choices.js
    var selectStateInputEl = d.querySelector("#state");
    if (selectStateInputEl) {
        const choices = new Choices(selectStateInputEl);
    }

    // Sortable Js
    if (d.body.clientWidth > breakpoints.lg) {
        var kanbanColumn1 = document.getElementById("kanbanColumn1");
        if (kanbanColumn1) {
            new Sortable(kanbanColumn1, {
                group: "shared",
            });
        }

        var kanbanColumn2 = document.getElementById("kanbanColumn2");
        if (kanbanColumn2) {
            new Sortable(kanbanColumn2, {
                group: "shared",
            });
        }

        var kanbanColumn3 = document.getElementById("kanbanColumn3");
        if (kanbanColumn3) {
            new Sortable(kanbanColumn3, {
                group: "shared",
            });
        }

        var kanbanColumn4 = document.getElementById("kanbanColumn4");
        if (kanbanColumn4) {
            new Sortable(kanbanColumn4, {
                group: "shared",
            });
        }
    }

    // multiple
    var selectStatesInputEl = d.querySelector("#states");
    if (selectStatesInputEl) {
        const choices = new Choices(selectStatesInputEl);
    }

    // Pricing countup
    var billingSwitchEl = d.getElementById("billingSwitch");
    if (billingSwitchEl) {
        const countUpStandard = new countUp.CountUp("priceStandard", 99, {
            startVal: 199,
        });
        const countUpPremium = new countUp.CountUp("pricePremium", 199, {
            startVal: 299,
        });

        billingSwitchEl.addEventListener("change", function () {
            if (billingSwitch.checked) {
                countUpStandard.start();
                countUpPremium.start();
            } else {
                countUpStandard.reset();
                countUpPremium.reset();
            }
        });
    }

    if (sidebar) {
        if (localStorage.getItem("sidebar") === "contracted") {
            sidebar.classList.add("notransition");
            content.classList.add("notransition");
            $("#separator").addClass("w-45");
            $("#separator1").addClass("w-45");
            sidebar.classList.add("contracted");

            setTimeout(function () {
                sidebar.classList.remove("notransition");
                content.classList.remove("notransition");
            }, 500);
        } else {
            sidebar.classList.add("notransition");
            content.classList.add("notransition");

            sidebar.classList.remove("contracted");

            setTimeout(function () {
                sidebar.classList.remove("notransition");
                content.classList.remove("notransition");
            }, 500);
        }

        var sidebarToggle = d.getElementById("sidebar-toggle");
        sidebarToggle.addEventListener("click", function () {
            if (sidebar.classList.contains("contracted")) {
                sidebar.classList.remove("contracted");
                localStorage.removeItem("sidebar", "contracted");
                $("#separator").removeClass("w-45");
                $("#separator1").removeClass("w-45");
            } else {
                sidebar.classList.add("contracted");
                localStorage.setItem("sidebar", "contracted");
                $("#separator").addClass("w-45");
                $("#separator1").addClass("w-45");
            }
        });

        sidebar.addEventListener("mouseenter", function () {
            if (localStorage.getItem("sidebar") === "contracted") {
                if (sidebar.classList.contains("contracted")) {
                    sidebar.classList.remove("contracted");
                    $("#separator").removeClass("w-45");
                    $("#separator1").removeClass("w-45");
                } else {
                    sidebar.classList.add("contracted");
                    $("#separator").addClass("w-45");
                    $("#separator1").addClass("w-45");
                }
            }
        });

        sidebar.addEventListener("mouseleave", function () {
            if (localStorage.getItem("sidebar") === "contracted") {
                if (sidebar.classList.contains("contracted")) {
                    sidebar.classList.remove("contracted");
                    $("#separator").removeClass("w-45");
                    $("#separator1").removeClass("w-45");
                } else {
                    sidebar.classList.add("contracted");
                    $("#separator").addClass("w-45");
                    $("#separator1").addClass("w-45");
                }
            }
        });
    }
});

function pullDeleteBookModal(btn) {
    var modal = document.getElementById("deleteSingleBook");
    modal.querySelector("form").action =
        "/books/" + $(btn).attr("data-book-id");
    $(modal).modal("toggle");
}
