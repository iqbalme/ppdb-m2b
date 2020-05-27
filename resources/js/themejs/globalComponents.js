import BaseInput from '../components/themeComponents/Inputs/BaseInput.vue'
import BaseCheckbox from '../components/themeComponents/Inputs/BaseCheckbox.vue'
import BaseRadio from '../components/themeComponents/Inputs/BaseRadio.vue'
import BaseDropdown from '../components/themeComponents/BaseDropdown.vue'
import Card from '../components/themeComponents/Cards/Card.vue'

/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install (Vue) {
    Vue.component(BaseInput.name, BaseInput)
    Vue.component(BaseCheckbox.name, BaseCheckbox)
    Vue.component(BaseRadio.name, BaseRadio)
    Vue.component(BaseDropdown.name, BaseDropdown)
    Vue.component('card', Card)
  }
}

export default GlobalComponents
