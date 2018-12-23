const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;

registerBlockType( 'gutenberg-boilerplate-es5/shop-page-wp', {
    title: 'Shop Page WP',

    icon: 'cart',

    category: 'widgets',

    attributes: {
        content: {
            // type: 'string',
            // source: 'html',
            // selector: 'p',
            type: 'array',
            source: 'children',
            selector: '.top-section',
        },
        contentNew: {
            type: 'array',
            source: 'children',
            selector: '.bottom-section',
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { content, contentNew } = attributes;

        function onChangeContent( newContent ) {
            setAttributes( { content: newContent } );
        }

        function onChangeNewContent( newContent ) {
            setAttributes( { contentNew: newContent } );
        }

        return (
            <div >
            <RichText
                tagName="div"
                //className={ className }
                className="top-section"
                onChange={ onChangeContent }
                value={ content }
            />
            <RichText
                tagName="div"
                //className={ className }
                className="bottom-section"
                onChange={ onChangeNewContent }
                value={ contentNew }
            />
            </div>
        );
    },

    save( { attributes } ) {
        const { content, contentNew } = attributes;

        return (
            <div>
            <RichText.Content
                tagName="div"
                value={ content }
            />
            <RichText.Content
                tagName="div"
                value={ contentNew }
            />
            </div>
        );
    },
} );