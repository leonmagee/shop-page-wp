const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, PlainText } = wp.editor;
const { Button, TextControl, SelectControl, ServerSideRender } = wp.components;
//const { withState } = wp.compose;

registerBlockType( 'gutenberg-boilerplate-es5/shop-page-wp', {
    title: 'Shop Page WP',

    icon: 'cart',

    category: 'widgets',

    attributes: {
        title: {
            type: 'string',
            selector: '.shop-page-wp-title',
        },
        grid: {
            type: 'string',
            selector: '.shop-page-wp-grid',
        },
        category: {
            type: 'string',
            selector: '.shop-page-wp-cats',
        },
        max_number: {
            type: 'string',
            selector: '.shop-page-wp-max-products',
        },
    },

    edit( { attributes, className, setAttributes } ) {
        //console.log('here are the attributes?', attributes);
        const { title, grid, category, max_number } = attributes;

        function onChangeTitle( newTitle ) {
            setAttributes( { title: newTitle } );
        }

        function onChangegrid( newGrid ) {
            setAttributes( { grid: newGrid } );
        }

        function onChangeCats( newCats ) {
            setAttributes( { category: newCats } );
        }

        function onChangemax_number( newMaxNumber ) {
            setAttributes( { max_number: newMaxNumber } );
        }

        return (
            <div className={ className }>
                <TextControl
                    label="Title (optional)"
                    className="shop-page-wp-title"
                    onChange={ onChangeTitle }
                    type="text"
                    value={ title }
                />
                <SelectControl
                    label="Number of grid"
                    className="shop-page-wp-grid"
                    value={ grid }
                    options={ [
                     { label: '1 Column', value: '1' },
                     { label: '2 grid', value: '2' },
                     { label: '3 grid', value: '3' },
                     { label: '4 grid', value: '4' },
                    ] }
                    onChange={ onChangegrid }
                />
                <TextControl
                    label="category (Separate multiple by pipe | symbol)"
                    className="shop-page-wp-cats"
                    onChange={ onChangeCats }
                    type="text"
                    value={ category }
                />
                <TextControl
                    label="Max Number of Products"
                    className="shop-page-wp-max-products"
                    onChange={ onChangemax_number }
                    type="number"
                    value={ max_number }
                />
            </div>
        );
    },

    save({attributes}) {

        const { title, grid, category, max_number } = attributes; // this is important?
        
        return null;
    },
} );