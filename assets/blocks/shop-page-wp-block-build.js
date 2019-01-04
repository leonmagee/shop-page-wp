/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$editor = wp.editor,
    RichText = _wp$editor.RichText,
    PlainText = _wp$editor.PlainText;
var _wp$components = wp.components,
    Button = _wp$components.Button,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    ServerSideRender = _wp$components.ServerSideRender;


registerBlockType('shop-page-wp/grid', {
    title: 'Shop Page WP',
    icon: 'cart',
    category: 'widgets',
    attributes: {
        grid: {
            type: 'string',
            selector: '.shop-page-wp-grid'
        },
        category: {
            type: 'string',
            selector: '.shop-page-wp-cats'
        },
        max_number: {
            type: 'string',
            selector: '.shop-page-wp-max-products'
        }
    },

    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            className = _ref.className,
            setAttributes = _ref.setAttributes;
        var grid = attributes.grid,
            category = attributes.category,
            max_number = attributes.max_number;


        function onChangegrid(newGrid) {
            setAttributes({ grid: newGrid });
        }

        function onChangeCats(newCats) {
            setAttributes({ category: newCats });
        }

        function onChangemax_number(newMaxNumber) {
            setAttributes({ max_number: newMaxNumber });
        }

        return wp.element.createElement(
            'div',
            { className: className },
            wp.element.createElement(
                'h4',
                null,
                __("Product Grid"),
                ' - Shop Page WP'
            ),
            wp.element.createElement(SelectControl, {
                label: __("Number of Columns"),
                className: 'shop-page-wp-grid',
                value: grid,
                options: [{ label: '1 Column', value: '1' }, { label: '2 Columns', value: '2' }, { label: '3 Columns', value: '3' }, { label: '4 Columns', value: '4' }],
                onChange: onChangegrid
            }),
            wp.element.createElement(TextControl
            //label={ __("category (Separate multiple by pipe | symbol)") }
            , { label: __("Categories (Separate multiple by pipe | symbol)  Leave Blank to Display All"),
                className: 'shop-page-wp-cats',
                onChange: onChangeCats,
                type: 'text',
                value: category || ''
            }),
            wp.element.createElement(TextControl, {
                label: __("Max Number of Products to Display"),
                className: 'shop-page-wp-max-products',
                onChange: onChangemax_number,
                type: 'number',
                value: max_number || ''
            })
        );
    },
    save: function save(_ref2) {
        var attributes = _ref2.attributes;
        var grid = attributes.grid,
            category = attributes.category,
            max_number = attributes.max_number; // this is important?

        return null;
    }
});

/***/ })
/******/ ]);