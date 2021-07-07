<div class="mb-5">
    {{ $question }}
</div>
<div class="mb-5 flex justify-between">
    <div>
        <div class="grid grid-cols-2 gap-4 px-5 text-center">
            <div class="flex flex-col justify-center px-5">
                <span class="px-3" x-text="answer.length"></span>
            </div>
            {{ $word_count }}
            <a href="#" @click.prevent="answer = answer.replace(/\s+/g, '');">空白を削除</a>
            <a href="#" @click.prevent="answer = answer.replace(/[A-Za-z0-9]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
                });">全角に変換
            </a>
        </div>
    </div>
    {{ $answer }}
</div>