<script>
import { usePage } from '@inertiajs/vue3'
import { defineComponent, h } from 'vue'
import ResponsiveNavLink from './ResponsiveNavLink.vue'

export default defineComponent({
    setup() {
        return props => {
            const menus = Array.isArray(usePage().props.menus)
                ? usePage().props.menus
                : Object.values(usePage().props.menus)

            const active = menu => {
                if (menu) {
                    if (route().current(menu.route_or_url)) {
                        return true
                    }

                    for (let name of menu.routes) {
                        if (route().current(name)) {
                            return true
                        }
                    }

                    for (let child of menu.childs) {
                        if (active(child)) {
                            return true
                        }
                    }
                }

                return false
            }

            const size = (menu, i = 0) => {
                while (menu?.parent_id) {
                    i += 1
                    menu = menu.parent
                }

                return i
            }

            const generate = (menus) => {
                return menus.map(menu => {
                    const childs = menu.childs
                    const pl = size(menu) * 4
                    const href = (() => {
                        try {
                            return route(menu.route_or_url)
                        } catch (e) {
                            return menu.route_or_url
                        }
                    })()

                    if (childs.length) {
                        return h(ResponsiveNavLink, {
                            pl,
                            active: active(menu),
                            title: menu.name,
                            icon: menu.icon,
                        }, generate(childs, {
                            child: menu.parent_id !== null || menu.parent_id !== undefined,
                        }))
                    } else {
                        return h(ResponsiveNavLink, {
                            pl,
                            href,
                            icon: menu.icon,
                            active: active(menu),
                        }, menu.name)
                    }
                })
            }

            return h('div', {
                class: 'flex flex-col',
            }, generate(menus))
        }
    }
})
</script>