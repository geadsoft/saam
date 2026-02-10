<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/sams.png') }}" alt="" height="38">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span >@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <!--<a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span >Dashboard</span>
                    </a>-->
                    @can('Panel Bascula')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/bascula/panel">
                            <i class="ri-pie-chart-line"></i> <span>Panel Bascula </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/bascula/flujo-negocio">
                            <i class="ri-pie-chart-line"></i> <span>Panel Producción</span>
                        </a>
                    </li>
                    @endcan
                    @can('TalentoHumano')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/payroll/panel">
                            <i class="ri-pie-chart-line"></i> <span>Panel RRHH</span>
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/refineria/balance-masico">
                            <i class="ri-pie-chart-line"></i> <span>Balance Masico</span>
                        </a>
                    </li>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link" >@lang('translation.analytics')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link" >@lang('translation.crm')</a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link" >@lang('translation.ecommerce')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link" >@lang('translation.crypto')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link" >@lang('translation.projects')</a>
                            </li>
                             <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link" data-key="t-nft"> @lang('translation.nft') <span class="badge badge-pill bg-danger" data-key="t-new">@lang('translation.new')</span></a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span >@lang('translation.apps')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link" >@lang('translation.calendar')</a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat" class="nav-link" >@lang('translation.chat')</a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarEcommerce" >@lang('translation.ecommerce')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-products" class="nav-link" >@lang('translation.products')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-product-details" class="nav-link" >@lang('translation.product-Details')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-add-product" class="nav-link" >@lang('translation.create-product')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-orders" class="nav-link" >@lang('translation.orders')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-order-details" class="nav-link" >@lang('translation.order-details')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-customers" class="nav-link" >@lang('translation.customers')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-cart" class="nav-link" >@lang('translation.shopping-cart')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-checkout" class="nav-link" >@lang('translation.checkout')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-sellers" class="nav-link" >@lang('translation.sellers')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-seller-details" class="nav-link" >@lang('translation.sellers-details')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarProjects" >@lang('translation.projects')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProjects">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-projects-list" class="nav-link" >@lang('translation.list')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-overview" class="nav-link" >@lang('translation.overview')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-create" class="nav-link" >@lang('translation.create-project')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarTasks" >@lang('translation.tasks')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTasks">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tasks-kanban" class="nav-link" >@lang('translation.kanbanboard')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-list-view" class="nav-link" >@lang('translation.list-view')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-details" class="nav-link" >@lang('translation.task-details')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarCRM" >@lang('translation.crm')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCRM">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crm-contacts" class="nav-link" >@lang('translation.contacts')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-companies" class="nav-link" >@lang('translation.companies')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-deals" class="nav-link" >@lang('translation.deals')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-leads" class="nav-link" >@lang('translation.leads')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarCrypto" >@lang('translation.crypto')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCrypto">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crypto-transactions" class="nav-link" >@lang('translation.transactions')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-buy-sell" class="nav-link" >@lang('translation.buy-sell')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-orders" class="nav-link" >@lang('translation.orders')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-wallet" class="nav-link" >@lang('translation.my-wallet')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-ico" class="nav-link" >@lang('translation.ico-list')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-kyc" class="nav-link" >@lang('translation.kyc-application')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarInvoices" >@lang('translation.invoices')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInvoices">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-invoices-list" class="nav-link" >@lang('translation.list-view')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-details" class="nav-link" >@lang('translation.details')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-create" class="nav-link" >@lang('translation.create-invoice')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarTickets" >@lang('translation.supprt-tickets')
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTickets">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tickets-list" class="nav-link" >@lang('translation.list-view')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tickets-details" class="nav-link" >@lang('translation.ticket-details')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li class="nav-item">
                                <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft" data-key="t-nft-marketplace">
                                    NFT Marketplace <span class="badge badge-pill bg-danger" data-key="t-new">New</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarnft">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-nft-marketplace" class="nav-link" data-key="t-marketplace"> @lang('translation.marketplace') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-explore" class="nav-link" data-key="t-explore-now"> @lang('translation.explore-now') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-auction" class="nav-link" data-key="t-live-auction"> @lang('translation.live-auction') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-item-details" class="nav-link" data-key="t-item-details"> @lang('translation.item-details') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-collections" class="nav-link" data-key="t-collections"> @lang('translation.collections') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-creators" class="nav-link" data-key="t-creators"> @lang('translation.creators') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-ranking" class="nav-link" data-key="t-ranking"> @lang('translation.ranking') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-wallet" class="nav-link" data-key="t-wallet-connect"> @lang('translation.wallet-connect') </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-create" class="nav-link" data-key="t-create-nft"> @lang('translation.create-nft') </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>-->

                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i> <span >@lang('translation.layouts')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal" target="_blank" class="nav-link" >@lang('translation.horizontal')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached" target="_blank" class="nav-link" >@lang('translation.detached')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" target="_blank" class="nav-link" >@lang('translation.two-column')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered" target="_blank" class="nav-link" >@lang('translation.hovered')</a>
                            </li>
                        </ul>
                    </div>
                </li>--> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span >MODULOS</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/file/staff">
                        <i class="las la-user-tie"></i> <span>Personas</span>
                    </a>
                </li>
                <li class="nav-item">
                    @can('Bascula')
                    <a class="nav-link menu-link" href="#sidebarBascula" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="las la-truck"></i> <span data-key="t-landing">Bascula</span>
                    </a>
                    @endcan
                     <div class="collapse menu-dropdown" id="sidebarBascula">
                        <ul class="nav nav-sm flex-column">
                            @can('Bas-Compras')
                            <li class="nav-item">
                                <a href="/bascula/compras" class="nav-link" data-key="t-one-page">Compras</a>
                            </li>
                            @endcan
                            @can('Bas-Ventas')
                            <li class="nav-item">
                                <a href="/bascula/ventas" class="nav-link" data-key="t-one-page">Ventas</a>
                            </li>
                            @endcan
                            @can('Bas-Servicios')
                            <li class="nav-item">
                                <a href="/bascula/ventas" class="nav-link" data-key="t-one-page">Servicio</a>
                            </li>
                            @endcan
                            @can('Bas-Traslado')
                            <li class="nav-item">
                                <a href="/bascula/ventas" class="nav-link" data-key="t-one-page">Traslado</a>
                            </li>
                            @endcan
                            @can('Bas-Recepcion')
                            <li class="nav-item">
                                <a href="/bascula/ventas" class="nav-link" data-key="t-one-page">Recepcion</a>
                            </li>
                            @endcan
                            @can('Bas-Abastecimiento')
                            <li class="nav-item">
                                <a href="/bascula/abastecimiento" class="nav-link" data-key="t-one-page">Abastecimiento</a>
                            </li>
                            @endcan
                            @can('Bas-Tanque')
                            <li class="nav-item">
                                <a href="/bascula/tanque" class="nav-link" data-key="t-one-page">Tanque</a>
                            </li>
                            @endcan
                            @can('Bas-Certificados')
                            <li class="nav-item">
                                <a href="/bascula/certificados" class="nav-link" data-key="t-one-certificado">Certificados</a>
                            </li>
                            @endcan
                            @can('Bas-PCC')
                            <li class="nav-item">
                                <a href="/bascula/pcc" class="nav-link" data-key="t-nft-landing"> Perfil Fisicoquímico <span class="badge badge-pill bg-danger" data-key="t-new">New</span></a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @can('Contabilidad')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarcontabilidad" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-price-tag-3-line"></i> <span data-key="t-landing">Contabilidad</span>
                    </a>
                     <div class="collapse menu-dropdown" id="sidebarcontabilidad">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/contabilidad/catalogo_cuentas" class="nav-link" data-key="t-one-page">Plan de Cuentas</a>
                            </li>
                            <li class="nav-item">
                                <a href="/contabilidad/ccosto_cuentas" class="nav-link" data-key="t-one-page">Centro de Costo - Cuentas</a>
                            </li>
                            <!--<li class="nav-item">
                                <a href="nft-landing" class="nav-link" data-key="t-nft-landing"> NFT Landing <span class="badge badge-pill bg-danger" data-key="t-new">New</span></a>
                            </li>-->
                        </ul>
                    </div>
                </li>
                @endCan
                @can('Inventarios')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarinventario" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-line-height"></i> <span data-key="t-landing">Inventarios</span>
                    </a>
                     <div class="collapse menu-dropdown" id="sidebarinventario">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/inventario/producto-terminado" class="nav-link" data-key="t-one-page"> Producto Terminado </a>
                            </li>
                            <!--<li class="nav-item">
                                <a href="nft-landing" class="nav-link" data-key="t-nft-landing"> NFT Landing <span class="badge badge-pill bg-danger" data-key="t-new">New</span></a>
                            </li>-->
                        </ul>
                    </div>
                </li>
                @endcan
                @can('TalentoHumano')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRrhh" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-user-follow-line"></i> <span data-key="t-landing">Recursos Humanos</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRrhh">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/file/contracts">
                                    <i class="lab la-buffer"></i> <span>Contratos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarGestion" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarGestion">
                                    <i class="ri-information-line"></i> <span>Gestión</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarGestion">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/setting/generalities">Generalidades
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/form/areas" class="nav-link" role="button">Areás
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/form/charges" class="nav-link" role="button">Cargos
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/payroll/tiposrol" class="nav-link" role="button">Tipos de Rol
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/form/rubros" class="nav-link" role="button">Rubros
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/payroll/assign-rubros" class="nav-link" role="button">Rubros - Tipos Rol
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarNomina" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarNomina">
                                    <i class="ri-macbook-line"></i> <span>Nómina</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarNomina">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/form/periods">
                                                <i class="ri-folders-fill"></i> <span>Periodos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/payroll/prestamos">
                                                <i class="ri-hand-coin-fill"></i> <span>Préstamos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/payroll/planilla">
                                                <i class="las la-file-invoice"></i> <span>Planilla</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/payroll/horas-extras">
                                                <i class="mdi mdi-currency-usd"></i> <span>Horas Extras</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/payroll/nominas">
                                                <i class="las la-check-circle"></i> <span>Nómina</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarHturnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarHturnos">
                                    <i class="ri-history-line"></i> <span>Horarios y Turnos</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarHturnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/rrhh/horarios">
                                                <i class="ri-time-line"></i> <span>Horarios</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/rrhh/turnos">
                                                <i class="ri-fingerprint-line"></i> <span>Turnos</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/rrhh/asignar-turnos">
                                                <i class="mdi mdi-calendar-start"></i> <span>Asignar Turnos</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/rrhh/marcaciones">
                                                <i class="mdi mdi-alarm-check"></i> <span>Marcaciones</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/rrhh/vacaciones">
                                    <i class="mdi mdi-airplane"></i> <span>Vacaciones</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/rrhh/permisos">
                                    <i class="mdi mdi-timeline-check-outline"></i> <span>Permisos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarRrhhReporte" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarParametrosNomina">
                                    <i class="ri-printer-fill"></i> <span>Reportes</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarRrhhReporte">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rrhh/report-provisiones">
                                                <span>Provisiones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rrhh/report-prestamos">
                                                <span>Prestamos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarParametrosNomina" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarParametrosNomina">
                                    <i class="ri-settings-3-line"></i> <span>Configuración</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarParametrosNomina">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/setting/empresa">
                                                <i class="ri-community-line"></i> <span>Compañia</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="/setting/enlace-contables">
                                                <i class="ri-drag-drop-line"></i> <span>Enlace Contables</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <li class="nav-item">
                    @can('Reportes')
                    <a href="#sidebarReportes" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReportes" data-key="t-reportes">
                        <i class="las la-spinner"></i> <span data-key="t-reportes">Reportes</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown" id="sidebarReportes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarreportesTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarreportesTemplates" data-key="t-reportes-templates">
                                    Bascula <!--<span class="badge badge-pill bg-danger" data-key="t-new">New</span>-->
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarreportesTemplates">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-basic-action"> Compra Diaria </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-ecommerce-action"> Valores a Liquidar </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-ecommerce-action"> Fruta por Fecha Entrega </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
     <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
