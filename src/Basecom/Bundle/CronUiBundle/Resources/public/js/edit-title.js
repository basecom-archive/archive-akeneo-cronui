'use strict';
/**
 * Extension of the custom entity label to also include the basecom cronUI logo.
 *
 * @author    JM Leroux <jean-marie.leroux@akeneo.com>
 * @author    Jordan Kniest <j.kniest@basecom.de>
 */
define(
    ['pim/form', 'underscore', 'pim/user-context', 'pim/i18n', 'basecomcronui/templates/title-and-logo'],
    function (BaseForm, _, UserContext, i18n, template) {
        return BaseForm.extend({
            /**
             * {@inheritdoc}
             */
            render() {
                this.$el.html(
                    _.template(template)({
                        title: this.getLabel(),
                    })
                );
            },

            /**
             * Return the label of the currently editing cronjob.
             */
            getLabel() {
                const data = this.getFormData();
                let labels = [];

                if (undefined !== data.labels) {
                    labels = data.labels;
                }

                return i18n.getLabel(
                    labels,
                    UserContext.get('catalogLocale'),
                    data.code
                );
            }
        });
    }
);
