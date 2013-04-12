---
layout: post
title: 	最全linux终端命令及Unix操作命令
description:  收集整理linux和UNIX系统操作命令。
keywords: linux终端命令,Unix操作命令
category :  软件使用
date :  2013-05-09
tags : [教程, tip, 推荐]
---
**linux和UNIX系统操作命令**比较多，对新手来说由于不常使用，对许多操作命令命令不熟悉，今天 @hi@ 将收集的linux和unix常用基本命令整理共享，希望逐步更新 **最全linux终端命令及Unix操作命令**。需要注意的是命令和参数之间必需用空格隔开，参数和参数之间也必需用空格隔开，一行不能超过256个字符，大小写有区分。

## 登录工作站 
### 透过 PC 登录工作站 
执行格式：telnet hostname (在 dos 下执行) telnet ip-address 
Example: 
	telnet doc telnet 140.122.77.120
注: 可利用指令 arp hostname 或 arp domain_name 查询 ip_address2 

###登录步骤 

- login : _______ > 输入 username 
- password : _______ > 输入密码 

###登出步骤 
% logout 或 % exit 或 % 或按[Ctrl-D] 

###更改帐号密码 
passwd > 执行后将会出现下列信息 Changing NIS password for user on ice. 

Old password: ______ > 输入旧密码 

New password: ______ > 输入新密码(最好6-8字，英文字母与数字混合) 

Retype new password: ______ > 再输入一次密码 

###在线帮助指令说明 
执行格式： man command-name 

Example: % man ls 

###进入远端电脑系统 
执行格式：rlogin hostname [-1 username] 

Example: fdfd %rlogin doc remote login 进入工作站 doc 中。 

%rlogin doc -l user 使用 user 帐号进入工作站 doc 中。 

执行格式：telnet hostname 或 telnet IP address 

Example: 

%telnet doc or %telnet 140.109.20.251 

##文件或目录处理 
###列出文件或目录下之文件名称 
执行格式： ls [-atFlgR] [name] ( name 可为文件名或目录名称。) 

Example : 

ls 列出目前目录下之文件名。 

ls –a 列出包含以.起始的隐藏档所有文件名。 

ls –t 依照文件最后修改时间之顺序，依序列出文件名。 

ls –F 列出目前目录下之文件名及其类型。”/” 结尾表示为目录名称，“*” 结尾表示为执行档，”@” 结尾表示为 symblic link。 

ls –l 列出目录下所有文件之许可权、拥有者、文件大小、修改时间及名称。 

ls –lg 同上，并显示出文件之拥有者群组名称。 

ls –R 显示出目录下，以及其所有子目录之文件名。( recursive listing ) 

###目录之缩写： 
～ 使用者 login 时的 working directory ( 起始目录 ) 

～username 指定某位 user 的 working directory ( 起始目录 ) 

. 目前的工作目录 ( current working directory ) 

.. 目前目录的上一层目录 ( parent of working directory) 

###改变工作目录位置 
执行格式：cd [name] ：name 可为目录名称、路径或目录缩写。 

Example: 

cd 改变目录位置，至使用者 login 时的 working directory (起始目录)。 

cd dir1 改变目录位置，至 dir1 之目录位置下。 

cd ~user 改变目录位置，至使用者的 working directory (起始目录)。 

cd .. 改变目录位置，至目前目录的上层( 即 parent of working directory) 

cd ../user 改变目录位置，至相对路径 user 之目录位置下。 

cd /../.. 改变目录位置，至绝对路径( Full path ) 之目录位置下。 

###复制文件 
执行格式: cp [-r] source destination 

Example: 

cp file1 file2 将文件 file1 复制成 file2 

cp file1 dir1 将文件 file1 复制到目录 dir1 下，文件名仍为 file1。 

cp /tmp/file1 将目录 /tmp 下的文件 file1 复制到现行目录下，文件名仍为 file1。 

cp /tmp/file1 file2 将目录 /tmp 下的文件 file1 复制到现行目录下，文件名为 file2 

cp -r dir1 dir2 (recursive copy) 复制整个目录。若目录 dir2存在，则将目录 dir1，及其所有文件和子目录，复制到目录 dir2 下，新目录名称为 dir1。若目录 dir2 不存在，则将dir1，及其所有文件和子目录，复制为目录 dir2。 

###移动或更改文件、目录名称 
执行格式： mv source destination 

Example: 

mv file1 file2 将文件 file1，更改文件名为 file2。 

mv file1 dir1 将文件 file1，移到目录 dir1下，文件名仍为 file1。 

mv dir1 dir2 若目录 dir2 存在，则将目录 dir1，及其所有文件和子目录，移到目录 dir2 下，新目录名称为 dir1。若目录 dir2 不存在，则将dir1，及其所有文件和子目录，更改为目录 dir2。1 

###建立新目录 
执行格式： mkdir directory-name 

Exmaple ： 

mkdir dir1 建立一新目录 dir1。 

###删除目录 
执行格式： rmdir directory-name 或 rm -r directory-name 

Example ： 

rmdir dir1 删除目录 dir1，但 dir1 下必须没有文件存在，否则无法删除。 

rm -r dir1 删除目录 dir1，及其下所有文件及子目录。 

###删除文件 
执行格式： rm filename (filename 可为文件名，或文件名缩写符号。) 

Example ： 

rm file1 删除文件名为 file1 之文件。 

rm file? 删除文件名中有五个字符，前四个字符为file 之所有文件。 

rm f* 删除文件名中，以 f 为字首之所有文件。 

rm -rf file 删除名为file的文件夹及其里面的内容 

###文件名的缩写符号 
? 代表文件名称中之单一字符。 

代表文件名称中之一字串。 
###查看文件内容 
执行格式： cat filename 

Example ： 

cat file1 以连续显示方式，查看文件名 file1 之内容。 

执行格式： more filename 或 cat filename | more 

Example ： 

more file1 以分页方式，查看文件名 file1 之内容。 cat file1 | more 同上。 

###查看目录所占磁盘容量 
执行格式: du [-s] directory 

Example : 

du dir1 显示目录 dir1 的总容量及其次目录的容量(以 k byte 为容量)。 

du -s dir1 显示目录 dir1 的总容量。 

###查看自己的 disk quota 使用状况 
disk quota : 工作站磁盘空间的使用限额。 

执行格式: quota -v 

Example : 

quota -v 将会显示下列信息 Filesystem usage quota limit timeleft files quota limit timelef. /home/ice/u01 9344 8192 12288 1.9 days 160 0 0 

栏位解说: 

usage : 目前的磁盘用量。 

quota : 你的磁盘使用额度。当你的 usage 超过 quota 时，虽然可以继续使用，但是必须七天之内降到 quota 以下，否则即使用量没有超 limit(最高限额)，也无法再写入或复制任何文件。 

limit : 最高使用额度。当你的 usage 达到 limit 时，无法再写入或复制任何文件。 

##文件传输 
###拷贝文件或目录至远端工作站 
执行格式： rcp [-r] source hostname:destination 

source 可为文件名、目录名或路径，hostname 为工作站站名，destination 为路径名称. 

Example ： 

rcp file1 doc:/home/user 将文件 file1，拷贝到工作站 doc 路径 /home/user 之目录下。 

rcp -r dir1 doc:/home/user 将目录 dir1，拷贝到工作站 doc 路径/home/user 之目录下。 

###自远端工作站，拷贝文件或目录 
执行格式： rcp [-r] hostname:source destination 

( hostname 为工作站名，source 为路径名，destination 可为文件名、目录名或路径 )。 

Example ： 

rcp doc:/home/user/file1 file2 将工作站 doc 中，位于 /home/user 目录下之文件file1，拷贝到目前工作站之目录下，文件名改为file2。 

rcp -r doc:. 将工作站 doc 中，位于 /home/user 目录下之目录 dir1，拷贝到目前工作站之目录下目录名称仍为 dir1。 

##文件模式之设定 
###改变文件或目录之读、写、执行之允许权 
执行格式：chmod [-R] mode name 

( name 可为文件名或目录名;mode可为 3 个 8 位元之数字，或利用ls -l 命令，列出文件或目录之读、写、执行允许权之文字缩写。) 

mode : rwx rwx rwx r:read w:write x:execute 

user group other 

缩写 : (u) (g) (o) 

Example : 

%chmod 755 dir1 将目录dir1，设定成任何使用者，皆有读取及执行之权利，但只有拥有者可做修改。 

%chmod 700 file1 将文件file1，设定只有拥有者可以读、写和执行。 

%chmod o+x file2 将文件file2，增加拥有者可以执行之权利。 

%chmod g+x file3 将文件file3，增加群组使用者可执行之权利。 

%chmod o-r file4 将文件file4，除去其它使用者可读取之权利。 

###改变文件或目录之拥有权 
执行格式：chown [-R] username name ( name 可为文件名或目录名。) 

Example ： 

%chown user file1 将文件 file1 之拥有权，改为使用者 user 所有。 

%chown -R user dir1 将目录 dir1，及其下所有文件和子目录之拥有权，改为使用者 user 所有。 

###检查自己所属之群组名称 
执行格式：groups 

###改变文件或目录之群组拥有权 
执行格式：chgrp [-R] groupname name ( name 可为文件名或目录名 ) 

Example : 

%chgrp vlsi file1 将文件 file1 之群组拥有权，改为 vlsi 群组。 

%chgrp -R image dir1 将目录dir1，及其下所有文件和子目录，改为 image 群组。 

###改变文件或目录之最后修改时间 
执行格式：touch name ( name 可为文件或目录名称。) 

###文件之连结 
同一文件，可拥有一个以上之名称，可将文件做数个连结。 

执行格式：ln oldname newname ( Hard link ) 

Example ： 

ln file1 file2 　　将名称 file2，连结至文件 file1。 

执行格式：ln -s oldname newname ( Symblick link ) 

Example ： 

ln -s file3 file4　将名称 file4，连结至文件file3。 

###文件之字串找寻 
执行格式：grep string file 

Example ： 

grep abc file1 

寻找文件file1中，列出字串 abc 所在之整行文字内容。 

###找寻文件或命令之路径 
执行格式：whereis command ( 显示命令之路径。) 

执行格式：which command ( 显示命令之路径，及使用者所定义之别名。) 

执行格式：whatis command ( 显示命令功能之摘要。) 

执行格式：find search-path -name filename -print( 搜寻指定路径下，某文件之路径 。) 

Example ： 

%find / -name file1 -print ( 自根目录下，寻找文件名为 file1 之路径。. 

###比较文件或目录之内容 
执行格式：diff [-r] name1 name2 ( name1 name2 可同时为文件名，或目录名称。) 

Example : 

%diff file1 file2 比较文件 file1 与 file2 内，各行之不同处。 

%diff -r dir1 dir2 比较目录 dir1 与 dir2 内，各文件之不同处。 

###文件打印输出 
使用者可用 .login 档中之 setenv PRINTER，来设定打印资料时的打印机名。 

printername :sp1 或 sp2 

Example ： 

%setenv PRINTER sp2 设定自 sp2 打印资料。 

###一般文件之打印 
执行格式：lpr [-Pprinter-name] filename 

%lpr file1 或 lpr -Psp2 file1 自sp2，打印文件 file1。 

执行格式：enscript [-Pprinter-name] filename 

%enscript file3 或 enscript -Psp1 file3 自sp1， 打印文件 file3。 

###troff 文件之打印 
执行格式：ptroff [-Pprinter-name] [-man][-ms] filename 

%ptroff -man /usr/local/man/man1/ptroff.1 以 troff 格式，自 Apple laser writer 打印 ptroff 命令之使用说明。 

%ptroff -Psp2 -man /usr/man/man1/lpr1 以 troff 格式，自 sp2 打印 lpr 命令之使用说明。 

##打印机控制命令 
###检查打印机状态，及打印工作顺序编号和使用者名称 
执行格式：lpq [-Pprinter -name] 

%lpq 或 lpq -Psp1 检查 sp1 打印机之状态。 

###删除打印机内之打印工作 (使用者仅可删除自己的打印工作 ) 
执行格式：lprm [-Pprinter -name] username 或 job number 

%lprm user 或 lprm -Psp1 user 删除 sp1 中，使用者 user 的打印工作，此时使用者名称必须为 user。 

%lprm -Psp2 456 删除 sp2 编号为 456 之打印工作。 

##Job 之控制 
UNIX O.S.,可于 foregrourd 及 background 同时处理多个 process。 

一般使用者执行命令时，皆是在 foreground 交谈式地执行 process，亦可将 process置于 background 中，以非交谈式来执行 process。 

###查看系统之 process 
执行格式：ps [-aux] 

Example: 

%ps 或 ps –x (查看系统中，属于自己的 process。) 

%ps –au (查看系统中，所有使用者的 process。) 

%ps –aux (查看系统中，包含系统内部，及所有使用者的 process。) 

###结束或终止 process 
执行格式：kill [-9] PID ( PID 为利用 ps 命令所查出之 process ID。) 

Example: 

%kill 456 或 kill -9 456 终止 process ID 为 456 之 process。 

###在 background 执行 process 的方式 
执行格式：command & (于 command 后面加入一 “&” 符号即可。) 

Example: 

%cc file1.c & 将编译 file1.c 文件之工作，置于 background 执行。 

执行格式：按下 “Control Z” 键，暂停正在执行的 process。键入 “bg” 命令，将所暂停的 process，置入 background 中继续执行。 

Example: 

%cc file2.c ^Z Stopped %bg 

###查看正在 background 中执行的 process 
执行格式：jobs 

###结束或终止在 background 中的 process 
执行格式：kill %n 

(n 为利用 “jobs” 命令，所查看出的 background job 编号) 

Example: 

%kill % 终止在 background 中的第一个 job。 

%kill %2 终止在 background 中的第二个 job。 

##shell variable 
###查看 shell variable 之设定值 
执行格式：set 查看所有 shell variable 之设定值。 

%set 

执行格式：echo $variable-name 显示指定的 shell variable 之设定值。 

%echo $PRINTER0000 sp1 

###设定 shell variable 
执行格式：set var value 

Example: 

%set termvt100 设定 shell variable “term” 为 VT100 终端机之型式。 

###删除 shell variable 
执行格式：unset var 

Example: 

%unset PRINTER 删除 shell variable “PRINTER” 之设定值。 

##environment variable 
###查看 environment variable 之设定值 
执行格式：setenv 　查看所有 environment variable 之设定值。 

Example: 

%setenv 

执行格式：echo $NAME 显示指定的 environment variable “NAME” 之设定值。 

Example: 

%echo $PRINTER 

显示 environment variable “PRINTER” 打印机名称之设定值。 

###设定 environment variable 
执行格式：setenv NAME word 

Example: 

%setenv PRINTER sp1 

设定 environment variable “PRINTER” 打印机名称为 sp1。 

###删除 environment variable 
执行格式：unsetenv NAME 

Example: 

%unsetenv PRINTER 

删除 environment variable “PRINTER” 打印机名称之设定值。 

##alias 
###查看所定义的命令之 alias 
执行格式： alias 查看自己目前定义之所有命令，及所对应之 alias 名称。 

执行格式： alias name 查看指定之 alias 名称所定义之命令。 

Example: 

%alias dir (查看别名 dir 所定义之命令) ls -atl 

###定义命令之 alias 
执行格式： alias name \’command line\’ 

Example: 

% alias dir= \’ls -l\’ 将命令 “ls - l” 定义别名为 dir。 

###删除所定义之 alias 
执行格式： unalias name 

Example: 

%unalias dir (删除别名为 dir 之定义。) 

%unalias * (删除所有别名之设定。) 

##history 
###设定命令记录表之长度 
执行格式： set history n 

Example: 

%set history 40 

设定命令记录表之长度为 40 (可记载执行过之前面 40 个命令)。 

###查看命令记录表之内容 
执行格式： history 

###使用命令记录表 
执行格式： !! 

Example: %!! (重复执行前一个命令) 

执行格式： !n ( n 为命令记录表之命令编号。) 

Example: %!5 ( 执行命令记录表中第五个命令。) 

执行格式： !string ( 重复前面执行过以 string 为起始字符之命令。) 

Example: %!cat ( 重复前面执行过，以 cat 为起始字符之命令。) 

###显示前一个命令之内容 
执行格式： !!：p 

###更改前一命令之内容并执行之 
执行格式： ^oldstring ^newstring 

将前一命令中 oldstring 的部份，改成 newstring，并执行之。 

Example: 

%find . -name file1.c -print 

^file1.c^core 

%find . -name core -print 

注：文件 core 为执行程序或命令发生错误时，系统所产生的文件。作为侦错(debug)之，因其所占空间极大，通常将之删除。 

##资料之压缩 
为了避免不常用的文件或资料，占用太大的磁盘空间，请使用者将之压缩。欲使用压缩过的文件或资料前，将之反压缩，即可还原成原来之资料型式。凡是经过压缩处理之文件，会在文件名后面附加 ” .Z ” 之字符，表示此为一压缩文件。 

###压缩资料 
执行格式：compress filename 压缩文件执行格式：compressdir directory-name 压缩目录 

##pipe-line 之使用 
执行格式：command1 | command2 

将 command1 执行结果，送到 command2 做为 command2 的输入。 

Example: 

%ls -Rl | more 以分页方式，列出目前目录下所有文件，及子目录之名称。 

%cat file1 | more 以分页方式，列出文件 file1 之内容。 

##I/O control 
###标准输入之控制 
执行格式：command-line < file 

将 file 做为 command-line 之输入。 

Example: 

%mail -s "mail test" user@iis.sinica.edu.tw < file1 

将文件 file1 当做信件之内容，Subject 名称为 mail test,送给收信人。 

###标准输出之控制 
执行格式：command > filename 将 command 之执行结果，送至指定的 filename 中。 

Example: %ls -l > list 将执行 “ls -l” 命令之结果，写入文件 list 中。 

执行格式：command >! filename 同上，若 filename 之文件已经存在，则强迫 overwrite。 

Example: %ls -lg >! list 将执行 “ls - lg” 命令之结果，强迫写入文件 list 中。 

执行格式：command >& filename 将 command 执行时，屏幕上所产生的任何信息，写入指定的 filename 中。 

Example: %cc file1.c >& error 将编译 file1.c 文件时，所产生之任何信息，写入文件 error 中。 

执行格式：command >> filename 将 command 执行结果，附加(append)到指定的 filename 中。 

Example: %ls - lag >> list 将执行 “ls - lag” 命令之结果，附加(append)到文件 list 中。 

执行格式：command >>& filename 将 command 执行时，屏幕上所产生的任何信息，附加于指定的 filename中。 

Example: %cc file2.c >>& error 将编译 file2.c 文件时，屏幕所产生之任何信息，附加于文件 error 中。 

##查看系统中的使用者 
执行格式： who 或 finger 

执行格式： w 

执行格式： finger username or finger username@domainname 

##改变自己的 username 进入其他使用者的帐号，拥有其使用权利。 
执行格式： su username 

Example: 

%su user 进入使用者 user 之帐号 

passwrod: 输入使用者 user 之密码 

##查看 username 
执行格式： whoami 查看 login 时，自己的 username。 

执行格式： whoami 查看目前的 username。若已执行过 “su”命令tch user)，则显示出此 user 之 username。 

##查看目前本地所有工作站的使用者 
执行格式: rusers > 结束 

##与某工作站上的使用者交谈 
执行格式: talk username@hostname 或 talk username@ip_address 

Example: 

1. 可先利用 rusers 指令查看网路上的使用者 

2. 假设自己的帐号是 u84987 ，在工作站 indian 上使用，现在想要与 doc 上的u84123 交谈。 

%talk u84123@doc > 此时屏幕上将会出现等待画面 

在对方(u84123)屏幕上将会出现下列信息 

Message from Talk_Daemon@Local_host_name at xx:xx 

talk: connection requested by u84987@indian 

talk: respond with: talk u84987@indian 

此时对方(u84123) 必须执行 talk u84987@indian 即可互相交谈。最后可按结束。 

##检查远端电脑系统是否正常 
执行格式：ping hostname 或 ping IP-Address Example: %ping doc 

##电子邮件(E-mail)的使用简介 
###将文件当做 E-mail 的内容送出 
执行格式：mail -s “Subject-string” username@address < filename 

Example 

%mail -s "program" user < file.c 将 file.c 当做 mail 的内容，送至 user, subject name 为 program。 

（实际上，在Ubuntu中并不能将邮件发送到邮箱，例如163邮箱，而是在/var/mail文件夹下面生成了一个以当前用户名为文件名的文件，并在其中指出了错误信息。） 

###传送 E-mail 给本地使用者 
执行格式：mail username %mail user 

###传送 E-mail 至 外地 
执行格式： mail username@receiver-address 

Example 

%mail paul@gate.sinica.edu.tw Subject : mail test 

键入信文内容 

按下 “Control D” 键或 ” . ” 键结束信文。连按两次 “Control C” 键，则中断工作，不送此信件。 Cc: ( Carbon copy : 复制一份信文，给其他的收信人 ) 

###检查所传送之 E-mail 是否送出，或滞留于本所之邮件伺服站中 
执行格式：/usr/lib/sendmail -bp 

( 若屏幕显示为 “Mail queue is empty” 之信息，表示 mail 已送出。 

若为其它错误信息，表示 E-mail 因故尚未送出。) 

###读取信件 
执行格式: mail 

常用指令如下: 

cd [directory] chdir to directory or home if none given 

d [message list] delete messages 

h print out active message headers 

m [user list] mail to specific users 

n goto and type next message 

p [message list] print messages 

q quit, saving unresolved messages in mbox 

r [message list] reply to sender (only) of messages 

R [message list] reply to sender and all recipients of messages 

s [message list] file append messages to file 

t [message list] type messages (same as print) 

u [message list] undelete messages 

v [message list] edit messages with display editor 

w [message list] file append messages to file, without from line 

x quit, do not change system mailbox 

z [-] display next [previous] page of headers 

! shell escape 
