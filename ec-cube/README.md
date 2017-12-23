# テーマ6 : EC-CUBE理解

## ディレクトリ名

* ec-cube


## 基本要件

* EC-CUBEとは何かを知る
* オープンソースとは何かを知る


## 応用要件

* EC-CUBE2.13.5をインストール
* 商品登録、会員登録、受注、その他を使ってみる
* その仕組み（ソースコード）を読み解く


## 手順

1. EC-CUBEをインストールする
  - (ec-cube/README.mdを参照)
  - ２回目以降のVagrant起動時にエラーが出る場合は下の解除方法を参考にする
2. フロント画面・管理画面を触ってみる
3. ソースコードを読みつつ、EC-CUBEをカスタマイズしてみる



-------




# EC-CUBE2.13.5の環境構築手順

## 以下の環境を想定
* Windows 7 Pro
* vagrant 1.6.1
* Virtual Box 4.3.10

※ Virtual Boxを4.3.12にアップデートすると環境変数に  
**C:/Program Files/Oracle/VirtualBox**  
を追加する必要がある


## 手順
### VirtualBoxが使えるようにBIOSの設定変更
IntelVTが無効になっていると、仮想マシンに64bit OSをインストールできないので  
>PCを再起動してESCを押し、BIOS Setupに入る  
VTを有効化  
設定を保存して再起動

具体的な方法はPCのメーカーにより異なるので各自で調べる  

### Vagrant, VirtualBoxなどをインストール
Vagrant : http://www.vagrantup.com/downloads.html  
VirtualBox : https://www.virtualbox.org/wiki/Downloads  
Git for Windows : https://git-for-windows.github.io/  

### 仮想マシンを起動
GitHubで [arisugi/eccube_techaca](https://github.com/arisugi/eccube_techaca) をfork  

Git Bashを開き、~/Documents 以下に eccube_techaca をclone  
eccube_techaca で仮想マシンを起動  
```
$ cd ~/Documents
$ git clone https://github.com/[GitHubのユーザー名]/eccube_techaca.git
$ cd eccube_techaca
$ vagrant up
```

※ /vagrant => C:/Users/[PCのユーザー名]/Documents/eccube_techaca/ でエラーが発生した場合、  
```
$ vagrant plugin uninstall vagrant-vbguest
$ vagrant plugin install --plugin-source https://rubygems.org/ --plugin-prerelease vagrant-vbguest
```

※ それでも同様のエラーが発生する場合、  
仮想マシンにSSH接続し、kernelをアップデート  
下記のパッケージをインストール  
その後、仮想マシンを再起動
```
$ vagrant ssh

[vagrant@localhost ~] $ sudo yum -y update kernel
[vagrant@localhost ~] $ sudo yum -y install kernel-devel kernel-headers dkms gcc gcc-c++
[vagrant@localhost ~] $ exit

$ vagrant reload
```


### EC-CUBEをインストール
ブラウザで [192.168.55.10/eccube-2.13.5-pgsql/html/install](192.168.55.10/eccube-2.13.5-pgsql/html/install) にアクセス

ECサイトの設定
>店名 : (任意)  
メールアドレス : (任意)  
ログインID : admin  
パスワード : password  

管理機能の設定
>ディレクトリ : admin  

WEBサーバーの設定  
>URL(通常) : デフォルト  
URL(セキュア) : デフォルト  

データベースの設定
>DBの種類 : PostgreSQL  
DB名 : eccube_2135_db  
DBユーザ : eccube_db_user  
DBパスワード : password  


## ※掲示板3に関して
~/Documents/eccube_techaca/www 以下に掲示板2で作成したソースコードを配置  
> 例 : ~/Documents/eccube_techaca/www/keijiban

掲示板用にDBを作成し、連携    
ブラウザで動作確認  
> 例 : 192.168.55.10/eccube_techaca/keijiban


## 参考

### ソースコードの読み方
* https://ecnomikata.com/column/8635/

### カスタマイズ例：
* http://blog.livedoor.jp/chibicoo/archives/50208181.html

### Vagrantでの２回目以降の起動時に出るエラーの解除方法

* Vagrant：1.9.1
* VirtualBox：5.1.14

#### Vagrant内

```bash
$ sudo yum -y update kernel
$ sudo yum -y install kernel-devel kernel-headers dkms gcc gcc-c++
$ sudo /etc/init.d/vboxadd setup
```

#### Vagrant外

```bash
vagrant reload
```

[VirtualBoxで64bit版OSを使うためにIntel VTを有効化する](http://d.hatena.ne.jp/torazuka/20100620/p1)  
[Vagrantのmountエラーを解決しようとしたらvboxのリビルドがこける](http://qiita.com/wakaba260/items/b5c87b7815b710f303a0)
