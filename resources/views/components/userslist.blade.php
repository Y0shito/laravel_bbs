<div class="container px-5 py-8 mx-auto">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ユーザー</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ブックマーク数</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    フォロー数</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    フォロワー数</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        @foreach ($userlist as $user)
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-base font-medium text-gray-900"><a
                                                        href="{{ route('userpage', ['id' => $user->user_id]) }}">{{ $user->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="text-base text-gray-900">{{ $user->total_bookmarked }}</div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="text-base text-gray-900">{{ $user->followings }}</div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="text-base text-gray-900">{{ $user->followers }}</div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-right">
                                        @if ($user->user_id === Auth::id())
                                            <div>
                                                <button
                                                    class="cursor-not-allowed text-white bg-gray-400 rounded py-1 px-2"
                                                    disabled>フォロー</button>
                                            </div>
                                        @else
                                            <form method="POST">
                                                @csrf
                                                @empty($user->is_following)
                                                    <button name="following_id" formaction="{{ route('follow') }}"
                                                        class="py-1 px-2 bg-blue-500 rounded text-white"
                                                        value="{{ $user->user_id }}">フォロー</button>
                                                @else
                                                    <button name="following_id" formaction="{{ route('unfollow') }}"
                                                        class="py-1 px-2 bg-red-500 rounded text-white"
                                                        value="{{ $user->user_id }}">フォローを外す</button>
                                                @endempty
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
