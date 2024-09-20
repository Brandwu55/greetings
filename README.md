# greetings


动手
----

如果要运行`make dev-tests`这个命令，recruit 这个容器里面没有装 make。
所以在Dockerfile里添加：
RUN apk update && \
apk add --no-cache make

- 如果你认为这个容器环境不存在值得改进的地方，也请提供用来支撑你这个看法的理由。

思考
----

当你完成上述动手项目后，请进一步思考并回答以下2个问题。

1. 我们准备的单元测试类（MyGreeterTest）是否存在问题？（是或者否）
   答：是

2. 如果问题1你的答案"是"的话，请问有哪些问题？以及你认为针对每个问题应该如何改善？
   有下面几个问题：
   2.1.根据返回值的长度>0，判断是否成功。这个显然是不合适的。 应该根据当前服务器的时区和时间，返回不同的消息字符串。
   2.2.单元测试覆盖的测试太少了，至少需要覆盖返回 "Good morning"，"Good afternoon"，"Good evening"
   2.3.单元测试的方法不是驼峰命名
   原来：test_init，test_greeting，建议改成testInit和testGreeting
