/**
 * A field which allows to select or specify a cron expression.
 *
 * @author    Jordan Kniest <j.kniest@basecom.de>
 */
'use strict';

define([
        'jquery',
        'underscore',
        'pim/form/common/fields/field',
        'basecomcronui/templates/fields/expression',
    ],
    function (
        $,
        _,
        BaseField,
        template
    ) {
        return BaseField.extend({
            template: _.template(template),
            events: {
                'change': function (event) {
                    this.errors = [];
                    this.updateModel(this.getFieldValue(event.target));
                },
                'click #cronjob-switch': function (event) {
                    this.useDropdown = !this.useDropdown;
                    this.render();
                    event.preventDefault();
                }
            },

            prefilled: {
                'select-below': '',
                'every-minute': '* * * * *',
                'every-five-minutes': '*/5 * * * *',
                'every-fifteen-minutes': '*/15 * * * *',
                'every-half-hour': '*/30 * * * *',
                'every-hour': '0 * * * *',
                'every-three-hours': '0 */3 * * *',
                'every-six-hours': '0 */6 * * *',
                'every-day': '0 0 * * *',
                'every-week': '0 0 * * 1',
                'every-month': '0 0 1 * *',
                'every-year': '0 0 1 1 *'
            },

            useDropdown: true,
            initialized: false,

            /**
             * {@inheritdoc}
             */
            renderInput(templateContext) {
                if (!this.initialized) {
                    const expression = this.getModelValue();
                    this.useDropdown = (Object.values(this.prefilled).indexOf(expression) > -1);
                    this.initialized = true;
                }

                return this.template(_.extend(templateContext, {
                    value: this.getModelValue(),
                    prefilled: this.prefilled,
                    useDropdown: this.useDropdown
                }));
            },

            /**
             * {@inheritdoc}
             */
            getFieldValue: function (field) {
                return $(field).val();
            }
        });
    });
