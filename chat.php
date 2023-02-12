function chatGPT($q)
{
    // 设置chatGPT的接口URL
    $api_url = 'https://api.openai.com/v1/completions';
    // 设置访问令牌
    $access_token = 'sk-...f9gT';
    // 设置请求的参数
    $data = array(
        //'prompt' => '写一段php调用chatGPT', // 要向chatGPT发送的问题
        'prompt' => $q,
        // 要向chatGPT发送的问题
        'model' => 'text-davinci-003',
        // 使用的模型名称
        'max_tokens' => 4000, // chatGPT返回的最大文本长度
    );
    // 使用curl发送请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
    CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token,
        )
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    $response_data = json_decode($response, true);
    if ($response_data['id']) {
        // 获取chatGPT返回的答案
        $answer = $response_data['choices'][0]['text'];
        return $answer;
        // 处理答案
    } else {
        // 处理错误
        // ...
        return '我不大理解你说的，能精炼点提问吗？';
    }
}