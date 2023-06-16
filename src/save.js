/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { InnerBlocks, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save( { attributes } ) {
	const blockProps = useBlockProps.save( {
		className: ''
	} );

	const innerBlocksProps = useInnerBlocksProps.save( {
		className: 'wp-block-emma-dialog__content'
	}	);

	var options = {
		'openOn': attributes.openOn,
		'openLinkAddress': attributes.openLinkAddress
	}

	if( attributes.openAutomatically ) {
		options.openAutomatically = attributes.openAutomatically;
		options.openLimitId = attributes.openLimitId
		options.openUsers = attributes.openUsers

		if( attributes.openAutomatically == 'delay' ) {
			options.openDelay = attributes.openDelay;
		}

		if( attributes.openLimit > 0 ) {
			options.openLimit = attributes.openLimit;
			options.openLimitExpiration = attributes.openLimitExpiration
		}
	}
	console.log(attributes);
	return (
		<dialog { ...blockProps } data-options={ JSON.stringify( options ) }>
			<div><a href="#" class="wp-block-emma-dialog__close"><span class="screen-reader-text">Close Dialog</span></a></div>
			<div
				{ ...innerBlocksProps }
			/>
		</dialog>
	);
}
