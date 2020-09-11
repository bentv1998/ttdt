"use strict";

/**
 * Define the output of this file. The output of CSS and JS file will be auto detected.
 *
 * @output plugins/global/plugins.bundle
 */


//** Begin: Global mandatory plugins
window.jQuery = window.$ = require("jquery");
require("bootstrap");
require("block-ui");
require("autosize");
require("clipboard");
window.moment = require("moment");
window.Sticky = require("sticky-js");
window.Raphael = require("raphael");
window.Popper = require("popper.js");
require("jquery-form");

// Toastr
require("toastr/build/toastr.css");
window.toastr = require("toastr");

// Tooltips
import Tooltip from "tooltip.js";

window.Tooltip = Tooltip;

// Perfect-Scrollbar
require("perfect-scrollbar/css/perfect-scrollbar.css");
window.PerfectScrollbar = require("perfect-scrollbar/dist/perfect-scrollbar");
//** End: Globally mandatory plugins

// Daterangepicker
require("bootstrap-daterangepicker/daterangepicker.css");
require("bootstrap-daterangepicker");

// Bootstrap-Select
require("bootstrap-select/dist/css/bootstrap-select.css");
require("bootstrap-select");

// Sweetalert2
require("sweetalert2/dist/sweetalert2.css");
import swal from "sweetalert2/dist/sweetalert2";
window.swal = swal;
// require("es6-promise-polyfill/promise.min.js");
require("../metronic/js/vendors/plugins/sweetalert2.init");

// Select2
require("select2/dist/css/select2.css");
require("select2");


// Tagify
require("@yaireo/tagify/dist/tagify.css");
window.Tagify = require("@yaireo/tagify/dist/tagify");
require("@yaireo/tagify/dist/tagify.polyfills.min");


// Dropzone

require("dropzone/dist/dropzone.css");
window.Dropzone = require("dropzone");
require("../metronic/js/vendors/plugins/dropzone.init");


// Summernote
require("summernote/dist/summernote.css");
require("summernote");

// Inputmask

import Inputmask from "inputmask";
window.Inputmask = Inputmask;

// Wnumb
window.wNumb = require("wnumb");

// jQuery-Validation
require("jquery-validation");
require("jquery-validation/dist/additional-methods.js");

//bootstrap datepicker
require('bootstrap-datepicker');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min');

// Font Icons
// require("../metronic/plugins/flaticon/flaticon.css");
// require("../metronic/plugins/flaticon2/flaticon.css");

//** End: Global optional plugins
