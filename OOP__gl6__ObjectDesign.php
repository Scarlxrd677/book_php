<?php

/** 

//--------------------------------------------------------------------------------------------------------------------------------------------//

// 6 Глава Объекты Проектирования

• Основы проектирования. Что понимается под проектированием и чем объектно-ориентированная структура кода отличается от про- цедурной.
• Область видимости класса. Как решить, что следует включить в класс.
• Инкапсуляция. Сокрытие реализации и данных в интерфейсе класса.
• Полиморфизм. Использование общего супертипа с целью разрешить прозрачную подстановку специализированных подтипов во время выполнения программы.
• UML. Использование диаграмм для описания объектно-ориентиро- ванных архитектур.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Определение проектного кода

Очень важно решить, каким будет характер этих классов в
проектируемой системе. Классы отчасти состоят из методов. 

Поэтому при определении классов необходимо решить, какие методы следует объеди- нить, 
чтобы они составляли одно целое. Но, как будет показано вэтой гла- ве, классы часто объединяются в отношения наследования, 
чтобы подчи- няться общим интерфейсам. Именно эти интерфейсы, или типы, должны стать первыми участниками проектируемой системы.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Ответственность

Клиентский код не несет ответственности за реализацию. 
Он использует предостав- ленный объект, не зная и даже не интересуясь, какому именно подклассу он принадлежит. 
Ему известно только, что он работает с объектом типа ParamHandler, в котором поддерживаются методы read () и
w r i t e (). 

Если процедурный код занят подробностями реализации, то объектно- ориентированный код работает только с интерфейсом, 
не заботясь о под- робностях реализации. А поскольку ответственность за реализацию лежит на объектах, а не на клиентском коде, 
то поддержку новых форматов будет нетрудно внедрить прозрачным образом.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Связанность

Связность - это степень, в которой соседние процедуры зависят одна от другой. 
В идеальном случае следует создавать компоненты, в которых ответственность разделена совершенно четко и ясно. 
Если по всему коду разбросаны связанные процедуры, то вскоре обнаружится, 
что их трудно сопровождать, потому что придется прилагать усилия для поиска мест, где необходимо внести изменения.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Тесная связь

в примере объектно-ориентированного
ни между собой, ни с клиентским кодом. И если бы потребовалось вне- дрить поддержку нового формата файла, то было бы достаточно создать
новый подкласс, изменив единственную проверку в статическом методе getInstance ().


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Ортогональность

Ортогональность способствует повторному использованию кода, поскольку готовые компоненты можно включать 
в новые системы без специальной их настройки. Такие компо- ненты должны иметь четко определенные входные 
и выходные данные, не- зависимые от какого-либо более обширного контекста. В ортогональный код легче вносить 
изменения, поскольку изменение реализации будет ло- кализовано втом компоненте, где вносятсяизменения.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Выбор классов

При моделировании реальной ситуации эта задача может показаться нетрудной. 
Как правило, объектно-ориентированные системы являются программным представлением реальных вещей, поскольку 
в них нередко применяются классы вроде Person, Invoice и Shop. Следовательно, можно предположить, что определение классов 
- это вопрос выявления некоторых объектов в системе и наделения их определенными функциями
с помощью методов. И хотя это неплохая отправная точка, она не лишена
скрытых опасностей. Если рассматривать класс как существительное, ко-
торым оперирует произвольное количество глаголов, то окажется, что он
будет все больше расширяться, потому что в ходе разработки и внесения
изменений потребуется, чтобы класс выполнял все больше и больше обя- занностей.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Полиморфизм

Полиморфизм - это поддержка нескольких реализаций на основе об- щего интерфейса. 
На первый взгляд такое определение может показаться сложным, но на самом деле это понятие должно быть вам уже знакомо. 
О необходимости полиморфизма обычно говорит наличие в коде большо- го количества условных операторов.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Инкапксляция

Инкапсуляция - это просто сокрытие данных и функциональных воз- можностей от клиентского кода. 
И в то же время это ключевое понятие объектно-ориентированного программирования.

На самом элементарном уровне данные инкапсулируются путем объявления свойств как private или protected. 
Скрывая свойство от клиент- ского кода, мы соблюдаем общий интерфейс и тем самым предотвращаем
случайное повреждение данных объекта.

Полиморфизм демонстрирует другой вид инкапсуляции. Скрывая различные реализации за общим интерфейсом, 
мы прячем основопо- лагающие стратегии от клиентского кода. Это означает, что любые из- менения, 
внесенные за этим интероейсом, являются прозрачными для более обширного контекста остальной системы.

Во-первых, инкапсуляция помогает создать ортогональный код. 
И во-вторых, степень инкапсуляции, которую можно соблюсти, к делу не относится. Инкапсуляция - это методика, которую должны 
в равной степени соблюдать как сами классы, так и их клиенты.


//--------------------------------------------------------------------------------------------------------------------------------------------//

// Забудьте, как это делается

На некоторое время отложите все это в сторону, выбросив из головы вся- кие процедуры и механизмы.

Думайте только о ключевых участниках системы: требующихся типах данных и интерфейсах. Безусловно, з
нание программируемого процесса окажет помощь в ваших размышлениях. В частности, классу, в котором открывается файл, 
необходимо передать имя этого файла; код базы дан-
ных должен оперировать именами таблиц, паролями и т.д. Но старайтесь, чтобы ход ваших мыслей следовал структурам и отношениям 
в разрабатываемом коде.

В итоге вы обнаружите, что реализация легко встанет на свое место за правильноопределенным интерфейсом. Итогда вы получите широкие 
возможности заменить, улучшить или расширить реализацию, если в этом возникнет потребность, не затрагивая остальную систему в более 
обширном контексте.

Чтобы сосредоточить основное внимание на интерфейсе, старайтесь мыслить категориями абстрактных базовых классов, а не конкретных до-
черних классов. Так, в рассмотренном выше примере кода для извлечения параметров интерфейс является самым важным аспектом проектирования. 
Для этого требуется тип данных,предназначенный для чтения и запи- си пар "имя-значение". Для такого типа данных важна именно эта обязанность,
а не реальный носитель, на котором будут сохраняться данные или способы их хранения и извлечения. Проектирование системы необходимо 
сосредоточить вокруг абстрактного класса ParamHandler, внедрив только конкретные стратегии, чтобы в дальнейшем можно 
было читать и записывать параметры. Таким образом, полиморфизм и инкапсуляция внедряют- ся впроектируемую систему с самого начала.

Такая структура уже тяготеет к использованию замены классов.

Но мы, конечно, знали с самого начала, что должны существовать тек- стовая и XML-реализации класса ParamHandler, которые, 
безусловно, оказывают влияние на проектируемый интерфейс. При проектировании интерфейсов всегда есть над чем подумать, 
прежде чем выбрать подходя- щее решение.
 

//--------------------------------------------------------------------------------------------------------------------------------------------//

// Четыре признака недоброкачественного кода

Очень немногие разработчики принимают совершенно правильные ре- ТЬшения еще на стадии проектирования. 
Большинство из них исправляют код по мере изменения требований к нему или в результате более 
полного понимания характера решаемой задачи.

Но по мере изменения кода он может в конечном счете выйти из-под
контроля. Если ввести метод в одном месте, а класс в другом, то система станет постепенно усложняться.

- Класс который слишком много знал

Передавать параметры из одного метода в другой может быть очень не- удобно. Почему бы не упростить дело, 
воспользовавшись глобальной пе- ременной? С помощью глобальной переменной всякий может получить доступ к общим данным.

- Дублирование кода

Выявите повторяющиеся компоненты в проектируемой системе. Воз-
можно, они каким-то образом связаны вместе. Дублирование обычно свидетельствует о наличии тесной связи компонентов. 
Если вы изменяете что-нибудь основательное в одной процедуре, то понадобится ли вносить исправления в похожие процедуры?

- Мастер на все руки

А что, если класс пытается сразу делать слишком много? Втаком случае
попробуйте составить список обязанностей класса. Вполне возможно, что
одна из них послужит основанием для создания отдельного класса. Оставить без изменения класс, 
выполняющий слишком много обязанностей, - значит вызвать определенные осложнения при создании его
подклассов.

- Условные конструкции

У вас, вероятно, будут веские причины для употребления инструкций if n s w i t c h в своем коде. Но иногда наличие подобных структур служит
сигналом прибегнуть к полиморфизму.

Если вы обнаружите, что проверяете некоторые условия в классе слиш-
ком часто, особенно если эти проверки повторяются в нескольких методах, то, возможно, это сигнализирует о том, 
что один класс нужно разделить на два класса или более.

*/

//--------------------------------------------------------------------------------------------------------------------------------------------//