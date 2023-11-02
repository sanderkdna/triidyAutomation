@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Triidy</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Reporte General</h2>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                        <div class="flex">
                                        <i data-lucide="mail" class="report-box__icon text-primary"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">0000</div>
                                    <div class="text-base text-slate-500 mt-1">Conversaciones Iniciadas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="thumbs-up" class="report-box__icon text-success"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">0000</div>
                                    <div class="text-base text-slate-500 mt-1">Respuestas Confirmadas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="thumbs-down" class="report-box__icon text-danger"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">0000</div>
                                    <div class="text-base text-slate-500 mt-1">Respuestas Rechazadas</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END: General Report -->

                </div>
            </div>
        </div>
    </div>
@endsection
