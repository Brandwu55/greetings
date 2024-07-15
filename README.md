为了方便保留了vendor目录。

希望你实现的这个类能通过我们预先准备的单元测试类（MyGreeterTest）

- 我们准备了⼀个容器运⾏环境来供你运⾏单元测试，你需要根据实际情况对它进⾏改进，⾄少满⾜ 以下条件：

- `make dev-tests` 这个命令可以在你的环境⾥运⾏。

- 运⾏结果显示，所有的测试项⽬都正常通过。

- 请⽤注释或者别的⽅式说明你的每个改进点的意图。

  答： 如果要运⾏`make dev-tests`这个命令，recruit 这个容器⾥⾯需要装 make。⽬前容器中没有装 make。 所以在 Dockerfile⾥添加： RUN apk update &&
  apk add --no-cache make 必须 CD 到 项目/php/目录下执行：make dev-tests

------

当你完成上述动⼿项⽬后，请进⼀步思考并回答以下 2 个问题。

1. 我们准备的单元测试类（MyGreeterTest）是否存在问题？（是或者否）

   答：是

2. 如果问题 1 你的答案"是"的话，请问有哪些问题？以及你认为针对每个问题应该如何改善？

   答：

    1. 根据返回值的⻓度>0，判断是否成功。这个显然是不合适的。 $this->assertTrue( strlen($this->greeter->greeting()) > 0 ); 应该根据时区和时间，返回不同的消息字符串。⽐如在某⼀时刻，不同的时区，那么返回的消息字符 串也是不⼀样的。上海这边可能是下午，但是 UTC 时区可能是上午，你返回"Good afternoon"就不 合适了。 单元测试我⽤Asia/Shanghai 和 UTC 这两个时区进⾏了测试。
    2. 单元测试覆盖的测试太少了，⾄少需要覆盖返回 "Good morning"，"Good afternoon"，"Good evening"， ⽽且需要覆盖几个时间的情况，⽐如 12 点，6 点。
    3. 单元测试的⽅法不是驼峰命名 目前方法名字是 test_init，test_greetin, 建议改成 testInit 和 testGreeting 驼峰命名方式。