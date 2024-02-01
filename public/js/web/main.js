/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/web/main"],{

/***/ "./resources/js/web/main.js":
/*!**********************************!*\
  !*** ./resources/js/web/main.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("/* provided dependency */ var $ = __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\");\n$(document).ready(function () {\n  // var fixmeTop = $('.navbar-finalstyle').offset().top;\n  // console.log(fixmeTop);\n  // $(window).scroll(function() {\n  //     var currentScroll = $(window).scrollTop();\n  //     if (currentScroll >= 30) {\n  //         $('.navbar-finalstyle').addClass('active-menu');\n  //     } else {\n  //         $('.navbar-finalstyle').removeClass('active-menu');\n  //     }\n  // });\n  $('nav#navigation-menu').mmenu({\n    classes: 'mm-white mm-slide',\n    searchfield: false,\n    counters: false,\n    header: false\n  });\n  setTimeout(function () {\n    $('#fs-popup-home').modal('show');\n  }, 7000);\n});\n$(window).on('scroll', function (event) {\n  if ($(this).scrollTop() > 100) {\n    $('.backgr-menu').addClass('fixed-top');\n  } else {\n    $('.backgr-menu').removeClass('fixed-top');\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanMiLCJtYXBwaW5ncyI6IjtBQUFBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBVztFQUN6QjtFQUNBO0VBQ0E7RUFDQTtFQUNBO0VBQ0E7RUFDQTtFQUNBO0VBQ0E7RUFDQTtFQUNBRixDQUFDLENBQUMscUJBQXFCLENBQUMsQ0FBQ0csS0FBSyxDQUFDO0lBQzNCQyxPQUFPLEVBQUUsbUJBQW1CO0lBQzVCQyxXQUFXLEVBQUUsS0FBSztJQUNsQkMsUUFBUSxFQUFFLEtBQUs7SUFDZkMsTUFBTSxFQUFFO0VBQ1osQ0FBQyxDQUFDO0VBQ0ZDLFVBQVUsQ0FBQyxZQUFZO0lBQ25CUixDQUFDLENBQUMsZ0JBQWdCLENBQUMsQ0FBQ1MsS0FBSyxDQUFDLE1BQU0sQ0FBQztFQUNyQyxDQUFDLEVBQUUsSUFBSSxDQUFDO0FBQ1osQ0FBQyxDQUFDO0FBQ0ZULENBQUMsQ0FBQ1UsTUFBTSxDQUFDLENBQUNDLEVBQUUsQ0FBQyxRQUFRLEVBQUUsVUFBU0MsS0FBSyxFQUFFO0VBQ25DLElBQUlaLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2EsU0FBUyxDQUFDLENBQUMsR0FBRyxHQUFHLEVBQUU7SUFDM0JiLENBQUMsQ0FBQyxjQUFjLENBQUMsQ0FBQ2MsUUFBUSxDQUFDLFdBQVcsQ0FBQztFQUMzQyxDQUFDLE1BQU07SUFDSGQsQ0FBQyxDQUFDLGNBQWMsQ0FBQyxDQUFDZSxXQUFXLENBQUMsV0FBVyxDQUFDO0VBQzlDO0FBQ0osQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3dlYi9tYWluLmpzPzhhNzIiXSwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgLy8gdmFyIGZpeG1lVG9wID0gJCgnLm5hdmJhci1maW5hbHN0eWxlJykub2Zmc2V0KCkudG9wO1xuICAgIC8vIGNvbnNvbGUubG9nKGZpeG1lVG9wKTtcbiAgICAvLyAkKHdpbmRvdykuc2Nyb2xsKGZ1bmN0aW9uKCkge1xuICAgIC8vICAgICB2YXIgY3VycmVudFNjcm9sbCA9ICQod2luZG93KS5zY3JvbGxUb3AoKTtcbiAgICAvLyAgICAgaWYgKGN1cnJlbnRTY3JvbGwgPj0gMzApIHtcbiAgICAvLyAgICAgICAgICQoJy5uYXZiYXItZmluYWxzdHlsZScpLmFkZENsYXNzKCdhY3RpdmUtbWVudScpO1xuICAgIC8vICAgICB9IGVsc2Uge1xuICAgIC8vICAgICAgICAgJCgnLm5hdmJhci1maW5hbHN0eWxlJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZS1tZW51Jyk7XG4gICAgLy8gICAgIH1cbiAgICAvLyB9KTtcbiAgICAkKCduYXYjbmF2aWdhdGlvbi1tZW51JykubW1lbnUoe1xuICAgICAgICBjbGFzc2VzOiAnbW0td2hpdGUgbW0tc2xpZGUnLFxuICAgICAgICBzZWFyY2hmaWVsZDogZmFsc2UsXG4gICAgICAgIGNvdW50ZXJzOiBmYWxzZSxcbiAgICAgICAgaGVhZGVyOiBmYWxzZSxcbiAgICB9KTtcbiAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnI2ZzLXBvcHVwLWhvbWUnKS5tb2RhbCgnc2hvdycpO1xuICAgIH0sIDcwMDApO1xufSk7XG4kKHdpbmRvdykub24oJ3Njcm9sbCcsIGZ1bmN0aW9uKGV2ZW50KSB7XG4gICAgaWYgKCQodGhpcykuc2Nyb2xsVG9wKCkgPiAxMDApIHtcbiAgICAgICAgJCgnLmJhY2tnci1tZW51JykuYWRkQ2xhc3MoJ2ZpeGVkLXRvcCcpO1xuICAgIH0gZWxzZSB7XG4gICAgICAgICQoJy5iYWNrZ3ItbWVudScpLnJlbW92ZUNsYXNzKCdmaXhlZC10b3AnKTtcbiAgICB9XG59KTtcbiJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsIm1tZW51IiwiY2xhc3NlcyIsInNlYXJjaGZpZWxkIiwiY291bnRlcnMiLCJoZWFkZXIiLCJzZXRUaW1lb3V0IiwibW9kYWwiLCJ3aW5kb3ciLCJvbiIsImV2ZW50Iiwic2Nyb2xsVG9wIiwiYWRkQ2xhc3MiLCJyZW1vdmVDbGFzcyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/admin/vendor"], () => (__webpack_exec__("./resources/js/web/main.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);