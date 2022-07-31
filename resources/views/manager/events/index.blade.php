<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント管理
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome />  ここがbodyなのでこの中にイベント情報を入れていく --}}
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-4 mx-auto">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- onclickを付け加える mb-4を付け加える --}}
                        <button onclick="location.href='{{ route('events.create')}}'" class="flex mb-4 ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</button>
                      {{-- <div class="flex flex-col text-center w-full mb-20">
                        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Pricing</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park skateboard authentic crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3 wolf moon twee</p>
                      </div> --}}
                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                                                                                            {{-- roundedはいらない --}}
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">イベント名</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">開始日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">終了日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">定員</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">表示・非表示</th>
                              {{-- <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td class="px-4 py-3">{{ $event->name }}</td>
                                <td class="px-4 py-3">{{ $event->start_date }}</td>
                                <td class="px-4 py-3">{{ $event->end_date }}</td>
                                <td class="px-4 py-3">後程</td>
                                <td class="px-4 py-3">{{ $event->max_people }} </td>
                                <td class="px-4 py-3">{{ $event->is_visible }} </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{ $events->links() }}
                      </div>
                      <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                        {{-- <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                          </svg>
                        </a>
                        今回は使わないので、カット--}}
                        {{-- <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                        切り取ってボタンの上の方に貼り付ける--}}
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</x-app-layout>
