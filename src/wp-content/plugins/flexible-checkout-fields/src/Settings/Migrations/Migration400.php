<?php

namespace WPDesk\FCF\Free\Settings\Migrations;

use WPDesk\FCF\Free\Settings\Form\EditFieldsForm;

/**
 * Two major changes in version 4.0.0:
 * - convert conditional logic options to a new format
 * - settings option_name in options table is now wpdesk_checkout_fields_settings
 */
class Migration400 implements Migration {

	const OLD_SETTINGS_OPTION_NAME = 'inspire_checkout_fields_settings';

	const ACTION_SHOW = 'show';
	const ACTION_HIDE = 'hide';

	const OPERATOR_AND = 'and';
	const OPERATOR_OR  = 'or';

	const CATEGORY_CART            = 'cart_contains';
	const CATEGORY_FCF_FIELD       = 'fcf_field';
	const CATEGORY_SHIPPING_METHOD = 'shipping_method';

	/**
	 * {@inheritdoc}
	 */
	public function get_version(): string {
		return '4.0.0';
	}

	/**
	 * {@inheritdoc}
	 */
	public function up() {
		$plugin_settings = get_option( self::OLD_SETTINGS_OPTION_NAME, [] );

		foreach ( $plugin_settings as $section_id => $section_fields ) {
			foreach ( $section_fields as $field_id => $field_data ) {

				$conditional_logic_info          = $this->extract_conditional_logic_info( $field_data );
				$field_data['conditional_logic'] = $this->format_conditional_logic( $conditional_logic_info );
				$field_data                      = $this->remove_deprecated_fields( $field_data );

				$plugin_settings[ $section_id ][ $field_id ] = $field_data;
			}
		}

		update_option( EditFieldsForm::SETTINGS_OPTION_NAME, $plugin_settings );
	}


	/**
	 * Extract conditional logic info from field data, in more readable format.
	 *
	 * @param array<string, mixed> $field_data
	 *
	 * @return array<string, mixed>
	 */
	private function extract_conditional_logic_info( array $field_data ): array {
		$categories = [
			'conditional_logic'                 => self::CATEGORY_CART,
			'conditional_logic_fields'          => self::CATEGORY_FCF_FIELD,
			'conditional_logic_shipping_fields' => self::CATEGORY_SHIPPING_METHOD,
		];

		$conditional_logic = [];
		foreach ( $categories as $field_key => $category ) {
			$action_key   = $field_key . '_action';
			$rules_key    = $field_key . '_rules';
			$operator_key = $field_key . '_operator';

			if (
				isset( $field_data[ $field_key ] )
				&& isset( $field_data[ $action_key ] )
				&& isset( $field_data[ $rules_key ] )
				&& isset( $field_data[ $operator_key ] )
			) {
				$action   = $field_data[ $action_key ];
				$rules    = $field_data[ $rules_key ];
				$operator = $field_data[ $operator_key ];

				$group_rules                  = $this->format_group( $category, $rules, $operator );
				$conditional_logic[ $action ] = array_merge( $conditional_logic[ $action ] ?? [], $group_rules );
			}
		}

		return $conditional_logic;
	}

	/**
	 * Formats conditional logic group settings.
	 *
	 * @param string $category
	 * @param array<mixed> $rules
	 * @param string $operator
	 *
	 * @return array<mixed>
	 */
	private function format_group( string $category, array $rules, string $operator ): array {
		$group = [];

		if ( self::OPERATOR_OR === $operator ) {
			foreach ( $rules as $rule ) {
				$group[] = [ $this->format_rule( $category, $rule ) ];
			}
		} elseif ( self::OPERATOR_AND === $operator ) {
			$and_rules = [];
			foreach ( $rules as $rule ) {
				$and_rules[] = $this->format_rule( $category, $rule );
			}
			$group[] = $and_rules;
		}

		return $group;
	}

	/**
	 * Formats conditional logic rule settings.
	 *
	 * @param string $category
	 * @param array<mixed> $rule
	 *
	 * @return array<mixed>
	 */
	private function format_rule( string $category, array $rule ): array {
		$new_rule = [];

		switch ( $category ) {
			case self::CATEGORY_CART:
				$new_rule['category']   = self::CATEGORY_CART;
				$new_rule['selection']  = $rule['what'];
				$new_rule['comparison'] = 'which_is';
				$new_rule['values']     = $rule['what'] === 'product' ? $rule['products'] : $rule['product_categories'];
				break;
			case self::CATEGORY_FCF_FIELD:
				$new_rule['category']   = self::CATEGORY_FCF_FIELD;
				$new_rule['selection']  = $rule['field'];
				$new_rule['comparison'] = 'is';
				$new_rule['values']     = [ $rule['value'] ];
				break;
			case self::CATEGORY_SHIPPING_METHOD:
				$new_rule['category']   = self::CATEGORY_SHIPPING_METHOD;
				$new_rule['selection']  = $rule['field'];
				$new_rule['comparison'] = 'is';
				$new_rule['values']     = [ $rule['value'] ];
				break;
		}

		return $new_rule;
	}

	/**
	 * Formats final conditional logic settings.
	 *
	 * @param array<mixed> $conditional_logic_info
	 *
	 * @return array<mixed>
	 */
	public function format_conditional_logic( array $conditional_logic_info ): array {
		$conditional_logic = [];

		foreach ( $conditional_logic_info as $action => $rules ) {
			$conditional_logic[] = [
				'action' => $action,
				'rules'  => $rules,
			];
		}

		return $conditional_logic;
	}

	/**
	 * Remove not needed fields.
	 *
	 * @param array<mixed> $field_data
	 *
	 * @return array<mixed>
	 */
	private function remove_deprecated_fields( array $field_data ): array {
		unset(
			$field_data['conditional_logic_action'],
			$field_data['conditional_logic_operator'],
			$field_data['conditional_logic_rules'],
			$field_data['conditional_logic_fields'],
			$field_data['conditional_logic_fields_action'],
			$field_data['conditional_logic_fields_operator'],
			$field_data['conditional_logic_fields_rules'],
			$field_data['conditional_logic_shipping_fields'],
			$field_data['conditional_logic_shipping_fields_action'],
			$field_data['conditional_logic_shipping_fields_operator'],
			$field_data['conditional_logic_shipping_fields_rules'],
			$field_data['conditional_logic_info']
		);

		return $field_data;
	}
}
