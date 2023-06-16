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
import { InnerBlocks, useBlockProps, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';
import { PanelBody, RadioControl, __experimentalNumberControl as NumberControl, TextControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { 
	attributes,
	setAttributes
} ) {
	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps( {
			className: 'wp-block-emma-dialog__content',
	} );

	if( attributes.openLimitId === null ) {
		setAttributes( { openLimitId: Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5) } );
	}

	function DelayOpenSettings() {
		if( attributes.openAutomatically == 'delay' ) {
			return (
				<NumberControl
					label="Open Delay"
					help="Define how many seconds after page load the dialog box should appear."
					value={ attributes.openDelay }
					min={ 0 }
					step="0.1"
					onChange={ ( value ) => 
						setAttributes( { openDelay: parseFloat( value ) } )
					}
				/>
			)
		}
	}

	function AutomaticOpenSettings() {
		if( attributes.openAutomatically == 'false' ) {
			return
		} else {
			return (
				<PanelBody
					title={ __( 'Automatic Open Settings' ) }
				>
					<DelayOpenSettings/>
					<NumberControl
						label="Open Limit"
						help="Define how many times this dialog box is allowed to appear. Use 0 for no limit."
						value={ attributes.openLimit }
						min={ 0 }
						onChange={ ( value ) => 
							setAttributes( { openLimit: parseInt( value ) } )
						}
					/>
					<NumberControl
						label="Open Limit Expiration"
						help="Define how many days before the open limit counter resets and the dialog is shown again. Use 0 for no limit."
						value={ attributes.openLimitExpiration }
						min={ 0 }
						onChange={ ( value ) => 
							setAttributes( { openLimitExpiration: parseInt( value ) } )
						}
					/>
					<TextControl
						label="Open Limit ID"
						help="The ID that will be used to track how many times this dialog box will appear. Defaults to a random string, but can be customized so that multiple dialog boxes will count toward the same limit."
						value={ attributes.openLimitId }
						onChange={ ( value ) => 
							setAttributes( { openLimitId: value } )
						}
					/>
					<RadioControl
						label="Show dialog for"
						selected={ attributes.openUsers }
						options={ [
							{ label: 'Logged-In Users', value: 'logged-in' },
							{ label: 'Logged-Out Users', value: 'logged-out' },
							{ label: 'Both', value: 'both' }
						] }
						onChange={ ( value ) => 
							setAttributes( { openUsers: value } )
						}
					/>
				</PanelBody>
			)
		}
	}

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Open Options' ) }
				>
					<TextControl
						label="Open Link"
						help={ "Enter the desired address of buttons/links that should open this dialog box when clicked. When making a button/link, point the link to the value entered here with a \"#\" in front of it (e.g. \"#dialog-link\")." }
						value={ attributes.openLinkAddress }
						onChange={ ( value ) => 
							{
								if( value !== "" && ! value.startsWith( "#" ) ) {
									value = "#" + value;
								}
								setAttributes( { openLinkAddress: value } )
							}
						}
					/>
					<RadioControl
						label="Open On"
						selected={ attributes.openOn }
						options={ [
							{ label: 'Desktop', value: 'desktop' },
							{ label: 'Mobile', value: 'mobile' },
							{ label: 'Both', value: 'both' }
						] }
						onChange={ ( value ) => 
							setAttributes( { openOn: value } )
						}
					/>
					<RadioControl
						label="Open Automatically"
						selected={ attributes.openAutomatically }
						options={ [
							{ label: 'Do Not Open Automatically', value: 'false' },
							{ label: 'Open Automatically After Delay', value: 'delay' },
							{ label: 'Open Automatically on Exit Intent', value: 'exit' }
						] }
						onChange={ ( value ) => 
							setAttributes( { openAutomatically: value } )
						}
					/>
				</PanelBody>
				<AutomaticOpenSettings/>
			</InspectorControls>
			<div { ...blockProps }>
				<div><a href="#" class="wp-block-emma-dialog__close"><span class="screen-reader-text">Close Dialog</span></a></div>
				<div { ...innerBlocksProps } />
			</div>
		</>
	);
}
