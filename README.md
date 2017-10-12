# retort
指定した名称のディレクトリを全てzip圧縮する

## インストール
```bash
composer require howyi/retort --dev
```


## 設定

cwd以下に `rtrt.yml` を配置する
```yaml
# 圧縮、解凍するディレクトリ名 Retort/ <-> Retort.zip
name: Retort
# 検索するディレクトリ一覧 src/ tests/ 以下を検索する設定
directories:
  - src
  - tests
```

## コマンド
ディレクトリを圧縮
```bash
./vendor/bin/rtrt seal
```
ディレクトリを解凍
```bash
./vendor/bin/rtrt heat
```
