import { i18n } from '../lang'

export default [
    {
        _name: 'CSidebarNav',
        _children: [
            {
                _name: 'CSidebarNavItem',
                name: i18n.t('firefly.dashboard'),
                to: '/dashboard',
                icon: 'cil-speedometer'
            },
            // subheader
            {
                _name: 'CSidebarNavTitle',
                _children: [i18n.t('firefly.financial_control')]
            },
            // top 3 things
            {
                _name: 'CSidebarNavItem',
                name: 'Budgets',
                to: '/charts',
                icon: 'cil-chart-pie'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Bills',
                to: '/theme/colors',
                icon: 'cil-chart-pie'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Piggy banks',
                to: '/charts',
                icon: 'cil-chart-pie'
            },
            // subheader
            {
                _name: 'CSidebarNavTitle',
                _children: [i18n.t('firefly.accounting')]
            },
            // menu for transactions
            {
                _name: 'CSidebarNavDropdown',
                name: 'Transactions',
                route: '/base',
                icon: 'cil-puzzle',
                items: [
                    {
                        name: 'Expenses',
                        to: '/base/breadcrumbs'
                    },
                    {
                        name: 'Revenue & income',
                        to: '/base/cards'
                    },
                    {
                        name: 'Transfers',
                        to: '/base/carousels'
                    },
                ]
            },
            // menu for automation
            {
                _name: 'CSidebarNavDropdown',
                name: 'Automation',
                route: '/base',
                icon: 'cil-puzzle',
                items: [
                    {
                        name: 'Recurring transactions',
                        to: '/base/breadcrumbs'
                    },
                    {
                        name: 'Rules',
                        to: '/base/cards'
                    },
                ]
            },
            // subheader
            {
                _name: 'CSidebarNavTitle',
                _children: [i18n.t('firefly.others')]
            },
            // menu for accounts
            {
                _name: 'CSidebarNavDropdown',
                name: 'Accounts',
                route: '/base',
                icon: 'cil-puzzle',
                items: [
                    {
                        name: 'Asset accounts',
                        to: '/base/tables'
                    },
                    {
                        name: 'Expense accounts',
                        to: '/base/cards'
                    },
                    {
                        name: 'Revenue accounts',
                        to: '/base/cards'
                    },
                    {
                        name: 'Liabilities',
                        to: '/base/cards'
                    },
                ]
            },
            // classification
            {
                _name: 'CSidebarNavDropdown',
                name: 'Classification',
                route: '/base',
                icon: 'cil-puzzle',
                items: [
                    {
                        name: 'Categories',
                        to: '/base/breadcrumbs'
                    },
                    {
                        name: 'Tags',
                        to: '/base/cards'
                    },
                ]
            },

            // menu for tools
            {
                _name: 'CSidebarNavDropdown',
                name: 'Tools',
                route: '/base',
                icon: 'cil-puzzle',
                items: [
                    {
                        name: 'Export data',
                        to: '/base/cards'
                    },
                ]
            },

            // reports
            {
                _name: 'CSidebarNavItem',
                name: 'Reports',
                to: '/charts',
                icon: 'cil-chart-pie'
            },
        ]
    }
]
