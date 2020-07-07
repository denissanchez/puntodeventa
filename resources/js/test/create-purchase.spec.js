import { mount } from '@vue/test-utils'
import CreatePurchase from '../components/create-purchase'


test('should mount without crashing', () => {
    const wrapper = mount(CreatePurchase)

    expect(CreatePurchase).toMatchSnapshot()
})
