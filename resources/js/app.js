import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);



(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Search bar toggle
     */
    if (select(".search-bar-toggle")) {
        on("click", ".search-bar-toggle", function (e) {
            select(".search-bar").classList.toggle("search-bar-show");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select(".quill-editor-default")) {
        new Quill(".quill-editor-default", {
            theme: "snow",
        });
    }

    if (select(".quill-editor-bubble")) {
        new Quill(".quill-editor-bubble", {
            theme: "bubble",
        });
    }

    if (select(".quill-editor-full")) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [
                        {
                            font: [],
                        },
                        {
                            size: [],
                        },
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ],
                    [
                        {
                            script: "super",
                        },
                        {
                            script: "sub",
                        },
                    ],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ],
                    [
                        "direction",
                        {
                            align: [],
                        },
                    ],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            theme: "snow",
        });
    }

    /**
     * Initiate TinyMCE Editor
     */
    const useDarkMode = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;

    // tinymce.init({
    //     selector: "textarea.tinymce-editor",
    //     plugins:
    //         "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",
    //     editimage_cors_hosts: ["picsum.photos"],
    //     menubar: "file edit view insert format tools table help",
    //     toolbar:
    //         "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",
    //     toolbar_sticky: true,
    //     toolbar_sticky_offset: isSmallScreen ? 102 : 108,
    //     autosave_ask_before_unload: true,
    //     autosave_interval: "30s",
    //     autosave_prefix: "{path}{query}-{id}-",
    //     autosave_restore_when_empty: false,
    //     autosave_retention: "2m",
    //     image_advtab: true,
    //     link_list: [
    //         {
    //             title: "My page 1",
    //             value: "https://www.tiny.cloud",
    //         },
    //         {
    //             title: "My page 2",
    //             value: "http://www.moxiecode.com",
    //         },
    //     ],
    //     image_list: [
    //         {
    //             title: "My page 1",
    //             value: "https://www.tiny.cloud",
    //         },
    //         {
    //             title: "My page 2",
    //             value: "http://www.moxiecode.com",
    //         },
    //     ],
    //     image_class_list: [
    //         {
    //             title: "None",
    //             value: "",
    //         },
    //         {
    //             title: "Some class",
    //             value: "class-name",
    //         },
    //     ],
    //     importcss_append: true,
    //     file_picker_callback: (callback, value, meta) => {
    //         if (meta.filetype === "file") {
    //             callback("https://www.google.com/logos/google.jpg", {
    //                 text: "My text",
    //             });
    //         }

    //         if (meta.filetype === "image") {
    //             callback("https://www.google.com/logos/google.jpg", {
    //                 alt: "My alt text",
    //             });
    //         }

    //         if (meta.filetype === "media") {
    //             callback("movie.mp4", {
    //                 source2: "alt.ogg",
    //                 poster: "https://www.google.com/logos/google.jpg",
    //             });
    //         }
    //     },
    //     templates: [
    //         {
    //             title: "New Table",
    //             description: "creates a new table",
    //             content:
    //                 '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>',
    //         },
    //         {
    //             title: "Starting my story",
    //             description: "A cure for writers block",
    //             content: "Once upon a time...",
    //         },
    //         {
    //             title: "New list with dates",
    //             description: "New List with dates",
    //             content:
    //                 '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>',
    //         },
    //     ],
    //     template_cdate_format: "[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]",
    //     template_mdate_format: "[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]",
    //     height: 600,
    //     image_caption: true,
    //     quickbars_selection_toolbar:
    //         "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
    //     noneditable_class: "mceNonEditable",
    //     toolbar_mode: "sliding",
    //     contextmenu: "link image table",
    //     skin: useDarkMode ? "oxide-dark" : "oxide",
    //     content_css: useDarkMode ? "dark" : "default",
    //     content_style:
    //         "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    // });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    /**
     * Initiate Datatables
     */
    /* const datatables = select(".datatable", true);
    datatables.forEach((datatable) => {
        new simpleDatatables.DataTable(datatable, {
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [
                {
                    select: 2,
                    sortSequence: ["desc", "asc"],
                },
                {
                    select: 3,
                    sortSequence: ["desc"],
                },
                {
                    select: 4,
                    cellClass: "green",
                    headerClass: "red",
                },
            ],
        });
    });
 */
    /**
     * Autoresize echart charts
     */
    const mainContainer = select("#main");
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select(".echart", true).forEach((getEchart) => {
                    echarts.getInstanceByDom(getEchart).resize();
                });
            }).observe(mainContainer);
        }, 200);
    }
})();

//LINE CHART
/* document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector("#lineChart"), {
        type: "line",
        data: {
            labels: [
                "Gennaio",
                "Febbraio",
                "Marzo",
                "Aprile",
                "Maggio",
                "Giugno",
                "Luglio",
                "Agosto",
                "Settembre",
                "Ottobre",
                "Novembre",
                "Dicembre",
            ],
            datasets: [
                {
                    label: "Messaggi",
                    data: [65, 59, 80, 81, 56, 55, 40, 20, 10, 55, 12, 12],
                    fill: false,
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0.5,
                },
                {
                    label: "Recensioni",
                    data: [59, 80, 81, 56, 55, 40, 20, 10, 55, 82, 32, 65],
                    fill: true,
                    borderColor: "rgb(237, 59, 59)",
                    tension: 0.4,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}); */

//BAR CHART
/* document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector("#barChart"), {
        type: "bar",
        data: {
            labels: [
                "Gennaio",
                "Febbraio",
                "Marzo",
                "Aprile",
                "Maggio",
                "Giugno",
                "Luglio",
                "Agosto",
                "Settembre",
                "Ottobre",
                "Novembre",
                "Dicembre",
            ],
            datasets: [
                {
                    label: "Statistiche voti",
                    data: [65, 59, 80, 81, 56, 55, 40, 43, 56, 12, 34, 76],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(201, 203, 207, 0.2)",
                    ],
                    borderColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}); */

//REQUIRED CHECKOBOX
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form-register");
    const specializationsContainer = document.getElementById(
        "specializations-container"
    );
    const specializationError = document.getElementById("specialization-error");
    const checkboxes = specializationsContainer.querySelectorAll(
        'input[type="checkbox"]'
    );

    form.addEventListener("submit", function (event) {
        const isChecked = Array.from(checkboxes).some(
            (checkbox) => checkbox.checked
        );
        if (!isChecked) {
            event.preventDefault();
            specializationError.classList.remove("d-none");
        } else {
            specializationError.classList.add("d-none");
        }
    });
});

//PREVIEW IMAGE REGISTER
document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("image");
    const uploadPreview = document.getElementById("uploadPreview");
    const previewContainer = document.getElementById("previewContainer");

    imageInput.addEventListener("change", function () {
        const [file] = imageInput.files;
        if (file) {
            uploadPreview.src = URL.createObjectURL(file);
            previewContainer.style.display = "block"; // Mostra il contenitore
        }
    });
});

//EDIT CHECKOBX
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("myForm").addEventListener("submit", function (e) {
        var checkboxes = document.querySelectorAll(".specialization:checked");
        if (checkboxes.length == 0) {
            e.preventDefault(); // Previene l'invio del form
            document
                .getElementById("specialization-error")
                .classList.remove("d-none"); // Mostra il messaggio di errore
        }
    });
});

//preview per le immagini

const previewImage = document.getElementById("image");
previewImage.addEventListener("change", (event) => {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(previewImage.files[0]);

    oFReader.onload = function (oFREvent) {
        //console.log(oFREvent);
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
});

document.addEventListener("DOMContentLoaded", function () {
    const previewImageEdit = document.getElementById("imageUpload");
    previewImageEdit.addEventListener("change", (event) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(event.target.files[0]);

        fileReader.onload = function (event) {
            document.getElementById("uploadPreview").src = event.target.result;
        };
    });
});

const previewCv = document.getElementById("cv");
previewCv.addEventListener("change", (event) => {
    var oFReader = new FileReader();
    // var image  =  previewImage.files[0];
    // console.log(image);
    oFReader.readAsDataURL(previewCv.files[0]);

    oFReader.onload = function (oFREvent) {
        //console.log(oFREvent);
        document.getElementById("uploadPreviewCv").src = oFREvent.target.result;
    };
});
